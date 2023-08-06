<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('is_admin')->only('create');
    // }

    public function index(Request $request): Renderable
    {
        // dd($request->all());
        $user = User::query();

        $fullNames = User::select( DB::raw("CONCAT(users.first_name,' ',users.last_name) as full_name"))
        ->pluck('full_name');

        // dd($request->input('fullNames'));

        if (!is_null($request->input('fullNames'))) {
            // dump('fullNames ' . $request->input('fullNames'));

            $fullNames = $request->input('fullNames');

            list($firstName, $lastName) = explode(' ', $fullNames);

            $user = $user->where('first_name', $firstName)
                         ->where('last_name', $lastName);
        }


        if (!is_null($request->get('username'))) {
            // dump('username' . $request->input('username'));
            $user = $user->where('username', $request->input('username'));
        }

        if (!is_null($request->get('email'))) {
            // dump('email' . $request->input('email'));
            $user = $user->where('email', $request->input('email'));
        }

        if (!is_null($request->get('is_active'))) {
            // dump('isactive_' . $request->input('is_active'));
            $user = $user->where('is_active', $request->input('is_active'));
        }

        if (!is_null($request->get('is_admin'))) {
            // dump('isadmin' . $request->input('is_admin'));
            $user = $user->where('is_admin', $request->input('is_admin'));
        }

        $user = $user->get();

        return view('User.index', compact('user' ,  'fullNames'));
    }

    public function create()
    {

        return view('User.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|string|min:4|unique:users',
            'email' => 'required |email',
            'first_name' => 'min:3 | max:15',
            'last_name' => 'min:3 | max:15',
            'is_admin' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            ],
        ]);


        $user = User::create($request->all()); //create=>new user() +save()

        //PRG
        return redirect()->route('users.index')->with('success' , 'user created');
    }

    public function show()
    {
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('User.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {

        $request->validate([
            'username' => 'required|string|min:4',
            'email' => 'required |email',
            'first_name' => 'min:3 | max:15',
            'last_name' => 'min:3 | max:15',
            'is_admin' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
            // 'password' => [
            //     'required',
            //     'min:8',
            //     'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
            // ],
        ]);
        // dd($request->all());
        $request = $request->except(['password']);
        $user = User::find($id);
        $user->update($request);
        return redirect()->route('users.index')->with('success' , 'user updated');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect(route('users.index'))->with('success' , 'user deleted');
    }
}
