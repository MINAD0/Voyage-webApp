<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        return view('auth.profile');
    }

    public function change_profile(Request $request) {

        // dd($request->all());

        $user= Auth::user();
        $oldUser = User::where('id',$user->id)->first();

        // dd($fichier);
        $oldUser->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'adresse' => $request->adresse,
        ]);
        session()->flash('success', 'Modification effectuée avec succès!');
        return back();
    }


    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
        $oldUser = User::where('id',$user->id)->first();
        $fichier = $oldUser->avatar; // Assuming you have a 'avatar' column in the users table

        if ($request->hasFile('avatar')) {
            // dd('No image file received.');
            // Delete the previous avatar if it exists
            $previousAvatarPath = 'storage/users' . $oldUser->avatar;
            if (Storage::exists($previousAvatarPath)) {
                Storage::delete($previousAvatarPath);
            }
            $fichier = Carbon::now()->timestamp . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $fichier);

            $oldUser->avatar = 'users/'.$fichier;
            $oldUser->save();
            // dd($oldUser);

            session()->flash('success', 'Profile picture updated successfully!');
            return back();
        } else {
            // Log or dd a message to see if the image is not being received in the request
            dd('No image file received.');
        }
    }

    public function change_password(Request $request){

        $validated = request()->validate(
            [
                'current_password' => 'required|min:8',
                'password' => 'required|min:8|confirmed'
            ]
        );

        $auth = Auth::user();

        if (!Hash::check($validated['current_password'], $auth->password))
        {
            return back()->with('error', "Le mot de passe actuel n'est pas valide");
        }

        if (strcmp($request->get('current_password'), $validated['password']) == 0)
        {
            return back()->with("error", "Le nouveau mot de passe ne peut pas être le même que votre mot de passe actuel.");
        }

        $user = User::find($auth->id);
        $user->password = Hash::make($validated['password']);
        $user->save();

        return back()->with('success', 'Le mot de passe a été changé avec succès');
    }


}
