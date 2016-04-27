<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Hash;
use Auth;
use Validator;
use App\Author;

class AuthorController extends Controller
{
    public function signUp()
    {
        return view('author.signup');
    }

    public function postSignUp(Request $request)
    {
        $emailParam = $request->input('email');
        $passwordParam = Hash::make($request->input('password'));
        $firstNameParam = $request->input('first_name');
        $lastNameParam = $request->input('last_name');

        $newAuthor = new Author;
        $newAuthor->code = str_random(32);
        $newAuthor->email = $emailParam;
        $newAuthor->password = $passwordParam;
        $newAuthor->first_name = $firstNameParam;
        $newAuthor->last_name = $lastNameParam;
        $newAuthor->save();

        return $newAuthor;
    }

    public function login($error=null)
    {
        $error_code = "1";
        if (isset($error)) {
            $error_code = $error;
        }
        return view('author.login', ['error_code'=>$error_code]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->action('AuthorController@login');
    }

    public function postLogin(Request $request)
    {
        $emailParam = $request->input('email');
        $passwordParam = $request->input('password');

        if (Auth::attempt(['email' => $emailParam, 'password' => $passwordParam])) {
            return redirect()->action('AuthorController@editProfile');
        }
        return redirect()->action('AuthorController@login', [0]);
    }

    public function editProfile()
    {
        $author = Auth::user();
        return view('author.edit-profile', ['author'=>$author]);
    }

    public function postEditProfile(Request $request)
    {
        $emailParam = $request->input('email');
        $codeParam = $request->input('code');
        $firstNameParam = $request->input('first_name');
        $lastNameParam = $request->input('last_name');

        $tempAuthor = Author::where('email', $emailParam)->where('code', $codeParam)->first();
        if (empty($tempAuthor)) { return redirect()->action('AuthorController@editProfile'); }
        $tempAuthor->first_name = $firstNameParam;
        $tempAuthor->last_name = $lastNameParam;
        if (strlen($request->input('password')) >= 6) {
            $tempAuthor->password = Hash::make($request->input('password'));
        }
        if ($request->hasFile('profile-picture')) {
            $tempProfilePic =  $this->uploadAuthorProfilePicture($request, $tempAuthor->code);
            if ($tempProfilePic['code'] == 1) {
                $tempAuthor->picture = $tempProfilePic['path'];
            }
        }
        $tempAuthor->save();
        return redirect()->action('AuthorController@editProfile');
    }

    private function uploadAuthorProfilePicture(Request $request, $code)
    {
        // getting all of the post data
        $file = array('image' => $request->file('profile-picture'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            return ['code'=>-1, 'path'=>''];
        }
        else {
            $extension = $request->file('profile-picture')->getClientOriginalExtension(); // getting image extension
            $fileName = $code.'.'.$extension; // renaming image
            $request->file('profile-picture')->move(storage_path().'/images/profile', $fileName);
            return ['code'=>1, 'path'=>$fileName];
        }
    }
}
