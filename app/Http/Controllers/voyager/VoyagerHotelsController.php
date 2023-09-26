<?php

namespace App\Http\Controllers\voyager;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Facades\Voyager;

class VoyagerHotelsController extends \TCG\Voyager\Http\Controllers\VoyagerBaseController
{
    public function store(Request $request)
{
    // Validate the request data, including the image upload
    $this->validate($request, [
        'nom_hotel' => 'required|string',
        'adresse_hotel' => 'required|string',
        'image_hotel' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image types and size as needed
        'type' => 'required|string',
        'rating' => 'required|numeric|min:1|max:5',
        'ville_id' => 'required|exists:villes,id', // Make sure the selected ville_id exists in the villes table
        'TypeChambre.*' => 'required|string',
        'tarif.*' => 'required|numeric',
    ]);

    // Handle image upload
    if ($request->hasFile('image_hotel')) {
        $imagePath = $request->file('image_hotel')->store('hotel_images', 'public');
        // Assuming you have a 'storage' symlink set up, 'hotel_images' is the directory where images will be stored in the 'public' disk.
        // You can adjust the path and disk as needed.
    } else {
        // Handle the case where no image was provided (optional)
        $imagePath = null;
    }

    // Create a new Hotel instance
    $hotel = new Hotel();

    // Set the properties based on the request data
    $hotel->nom_hotel = $request->input('nom_hotel');
    $hotel->adresse_hotel = $request->input('adresse_hotel');
    $hotel->image_hotel = $imagePath; // Store the image path in the database
    $hotel->type = $request->input('type');
    $hotel->rating = $request->input('rating');
    $hotel->ville_id = $request->input('ville_id');

    // Handle the Chambre and Tarif data (assuming these are related to the Hotel model)
    $hotel->type_chambre = $request->input('TypeChambre');
    $hotel->tarif = $request->input('tarif');
    // Save the hotel details to the database
    $hotel->save();



    $slug = $this->getSlug($request);

    $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

    return redirect()->back()->with([
        'message'    => __('voyager::generic.successfully_added_new')." {$dataType->getTranslatedAttribute('display_name_singular')}",
        'alert-type' => 'success',
    ]);
}


    public function index(Request $request, Hotel $id)
    {

        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // dd($dataType);

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];

        $searchNames = [];
        if ($dataType->server_side) {
            $searchNames = $dataType->browseRows->mapWithKeys(function ($row) {
                return [$row['field'] => $row->getTranslatedAttribute('display_name')];
            });
        }

        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', $dataType->order_direction);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $query = $model::select($dataType->name.'.*');

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query->{$dataType->scope}();
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model)) && Auth::user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';

                $searchField = $dataType->name.'.'.$search->key;
                if ($row = $this->findSearchableRelationshipRow($dataType->rows->where('type', 'relationship'), $search->key)) {
                    $query->whereIn(
                        $searchField,
                        $row->details->model::where($row->details->label, $search_filter, $search_value)->pluck('id')->toArray()
                    );
                } else {
                    if ($dataType->browseRows->pluck('field')->contains($search->key)) {
                        $query->where($searchField, $search_filter, $search_value);
                    }
                }
            }

            $row = $dataType->rows->where('field', $orderBy)->firstWhere('type', 'relationship');
            if ($orderBy && (in_array($orderBy, $dataType->fields()) || !empty($row))) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                if (!empty($row)) {
                    $query->select([
                        $dataType->name.'.*',
                        'joined.'.$row->details->label.' as '.$orderBy,
                    ])->leftJoin(
                        $row->details->table.' as joined',
                        $dataType->name.'.'.$row->details->column,
                        'joined.'.$row->details->key
                    );
                }

                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'browse', $isModelTranslatable);

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        // Actions
        $actions = [];
        if (!empty($dataTypeContent->first())) {
            foreach (Voyager::actions() as $action) {
                $action = new $action($dataType, $dataTypeContent->first());

                if ($action->shouldActionDisplayOnDataType()) {
                    $actions[] = $action;
                }
            }
        }

        // Define showCheckboxColumn
        $showCheckboxColumn = false;
        if (Auth::user()->can('delete', app($dataType->model_name))) {
            $showCheckboxColumn = true;
        } else {
            foreach ($actions as $action) {
                if (method_exists($action, 'massAction')) {
                    $showCheckboxColumn = true;
                }
            }
        }

        // Define orderColumn
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + ($showCheckboxColumn ? 1 : 0);
            $orderColumn = [[$index, $sortOrder ?? 'desc']];
        }

        // Define list of columns that can be sorted server side
        $sortableColumns = $this->getSortableColumns($dataType->browseRows);

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }

        return Voyager::view($view, compact(
            'actions',
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortableColumns',
            'sortOrder',
            'searchNames',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'showCheckboxColumn'
        ));
    }

    public function show(Request $request, $id)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {

            $model = app($dataType->model_name);
            $query = $model->query();

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses_recursive($model))) {
                $query = $query->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $query->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$query, 'findOrFail'], $id);
            $typeChambre = $dataTypeContent->type_chambre;
            $tarif = $dataTypeContent->tarif;
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'read', $isModelTranslatable);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted','tarif', 'typeChambre'));
    }

    public function create(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        // Eagerload Relations
        $this->eagerLoadRelations($dataTypeContent, $dataType, 'add', $isModelTranslatable);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }
}
