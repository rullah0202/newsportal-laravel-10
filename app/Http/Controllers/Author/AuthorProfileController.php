<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthorProfileController extends Controller
{
    public function index()
    {
        return view('author.profile');
    }

    public function profile_submit(Request $request)
    {
        $author_data = User::where('email',Auth::user()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        if($request->password!='') {
            $request->validate([
                'password' => 'required',
                'retype_password' => 'required|same:password'
            ]);
            $author_data->password = Hash::make($request->password);
        }

        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);

            @unlink(public_path('uploads/'.$author_data->photo));

            $now = time();
            $ext = $request->file('photo')->extension();
            $final_name = 'author_photo_'.$now.'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'),$final_name);

            $author_data->photo = $final_name;
        }

        
        $author_data->name = $request->name;
        $author_data->email = $request->email;
        $author_data->update();

        return redirect()->back()->with('success', 'Profile information is saved successfully.');
    }
}
