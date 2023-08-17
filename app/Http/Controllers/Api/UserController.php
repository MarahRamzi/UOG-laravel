<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //   return response()->json( User::paginate(2), 200);
         $user = User::with('address')->get();
        $Mainuser = [];
        $i = 0;
        foreach ($user as $users) {
            // dd($user);
            $Mainuser[$i]['id'] = $users->id;
            $Mainuser[$i]['full_name'] = $users->full_name;
            $Mainuser[$i]['address'] = $user->address;
            $i++;
        }

        return response()->json($Mainuser);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request , User $user)
    {

        $user = User::create($request->all());


        $user->address()->create($request->all());

        return response()->json($user, 201); //201=> ok and created
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return User::select([
        //     'full_name'
        // ])->findOrFail($id);

        $user = User::findOrFail($id);
        return [
            'id' => $user->id,
            'full_name' => $user->full_name,
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $user->address->update($request->all());

        return  response()->json([
            'message' => 'user updated',
            'user' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
            'message' => 'user deleted',
        ]);
    }
}