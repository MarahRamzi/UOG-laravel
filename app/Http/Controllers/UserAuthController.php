<?php

namespace App\Http\Controllers;

use App\Events\UserLoggedIn;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{

    public function register()
    {
        return view('cms.auth.register');
    }

    public function registerPost(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:4',
            'email' => 'required |email',
            'first_name'=>'min:3 | max:15',
            'last_name'=>'min:3 | max:15',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                'confirmed'

            ],
        ]);


        $user = User::create($request->all());

        return back()->with('success', 'Register successfully');
        return $request->last_name;

    }



    public function showLogin()
    {
        return view('cms.auth.login');

    }

    public function login(Request $request)
    {

        $validator = validator($request->all(), [
            'username' => 'required|string|min:4|unique:users',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            ],
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        $result = Auth::attempt($credentials , $request->boolean('remember'));

        if($result){

            event(new UserLoggedIn(auth()->user()));
            // dd(auth()->user());
              return redirect()->intended('/master');
        }
        return back()->withInput()->withErrors([
             'email' => 'invalid email' ,
             'password' => 'invalid password'  ,
         ]);

    }



        function logout()
        {

            Auth::logout();

            return redirect()->route('view.login');
        }

}
