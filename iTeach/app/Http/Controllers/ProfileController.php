<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{

    public function userProfile(){

        return view('profile.view');
    }

    public function updateProfile(Request $request){

        $request->validate([
            'email' => 'email|exists:users',

        ]);

        $user = User::findOrFail(Auth::user()->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $filename = "";

        // check form has a file
        if($request->hasFile('profile_picture'))
        {
            $file =  $request->file('profile_picture');
            $filename = md5(time()).'.'.$file->getClientOriginalExtension();
            $filePath = public_path('/profile-pic');
            $file->move($filePath,$filename);

            User::findOrFail(Auth::user()->id)->update([
                'profile_pic' => $filename
            ]);
        }

        session()->flash('success', 'Profile has been updated');
        return redirect(route('user.profile'));
    }
}
