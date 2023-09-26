@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp
                            <div class="mb-3">
                                <label class="form-check-label text-white" for="Nom_Hotel">
                                    Nom d'hotel
                                </label>
                                <input type="text" name="nom_hotel" class="form-control border-0 py-3" id="Nom_Hotel" required >
                            </div>
                            <div class="mb-3">
                                <label class="form-check-label text-white" for="Nom_Hotel">
                                    Adresee
                                </label>
                                <input type="text" name="adresse_hotel" class="form-control border-0 py-3" id="Nom_Hotel" required >
                            </div>
                            <div class="my-3">
                                <label class="form-check-label text-white" for="image">
                                    Image
                                </label>
                                <input type="file" name="image_hotel" class="form-control-file border-0 py-3" id="image" accept="image/*" required>
                            </div>
                            <div class="my-3">
                                <label class="form-check-label text-white" for="type">
                                    Type
                                </label>
                                <select class="form-control form-select p-4" id="type" data-trigger name="type"
                                id="choices-single-default"
                                placeholder="Rechercher ici">
                                <option value="">Type d'hotel </option>
                                <option value="national">National </option>
                                <option value="international">International </option>
                                </select>
                            </div>
                            <div class="my-3">
                                <label class="form-check-label text-white" for="rating">
                                    Rating
                                </label>
                                <input type="number" max="5" min="1" step="0.1" name="rating" class="form-control border-0 py-3" id="rating" required >
                            </div>
                            <div class="mb-3">
                                <label for="Ville_id">Ville</label>
                                <select class="form-control form-select p-4" id="Ville_id" data-trigger name="ville_id"
                                id="choices-single-default"
                                placeholder="Rechercher ici">
                                <option value="">choisi une ville </option>
                                @foreach ($villes as $ville)
                                    <option value="{{$ville->id}}">{{$ville->nom_ville}}</option>
                                @endforeach
                                </select>
                            </div>


                            {{-- add the  tabel --}}
                            <div class="container-fluid mt-4">
                                <a class="btn btn-primary float-right" id="addRow" type="button">add</a>
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>Type Chambre</th>
                                            <th>Tarification</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Rows will be added here -->
                                        <tr>
                                            <td>
                                                <select class="form-control form-select py-3 wd-200" id="TypeChambre" data-trigger name="TypeChambre"
                                                id="choices-single-default"
                                                placeholder="Rechercher ici">
                                                    <option value="">Select an option</option>
                                                    <option value="chambre single"> Chambre simple <i class="fas fa-ad"></i></option>
                                                    <option value="chambre double"> Chambre double <i class="fas fa-ad"></i></option>
                                                    <option value="chambre triple"> Chambre triple <i class="fas fa-ad"></i></option>
                                                </select>
                                            </td>
                                            <td><input type="text" value="" name="tarif" class="form-control"></td>
                                            <td><button class="btn btn-danger remove">Remove</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <div style="display:none">
                        <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
                        <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <script>
        $(document).ready(function () {
            $("#addRow").click(function () {
                var newRow = '<tr>' +
                    '<td><select class="form-control form-select py-3 wd-200" id="villeArrive" data-trigger name="hotel" id="choices-single-default" placeholder="Rechercher ici"><option value=""> Chambre simple <i class="fas fa-ad"></i></option><option value=""> Chambre double <i class="fas fa-ad"></i></option><option value=""> Chambre triple <i class="fas fa-ad"></i></option></select></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><button class="btn btn-danger remove">Remove</button></td>' +
                    '</tr>';
                $("#myTable tbody").append(newRow);
            });

            // Handle row removal
            $("#myTable").on('click', '.remove', function () {
                $(this).closest('tr').remove();
            });
        });
    </script>
@stop
