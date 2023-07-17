<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request): Renderable
    {
        $user = User::paginate(5);
        return view('User.index', compact('user'));
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
        return redirect()->route('users.index');
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

    public function update(Request $request, $id): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|string|min:4',
            'email' => 'required |email',
            'first_name' => 'min:3 | max:15',
            'last_name' => 'min:3 | max:15',
            'is_admin' => 'required|in:0,1',
            'is_active' => 'required|in:0,1',
            // 'password' => [
            //     'min:8',
            //     'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
            //     'confirmed'
            // ],
        ]);
        $request = $request->except(['password']);
        $user = User::find($id);
        $user->update($request);
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect(route('users.index'));
    }
}