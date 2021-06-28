<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Display a specified Item
     *
     * @param  User $user
     * @return Response
     */
    public function show($user)
    {
        if ($user == 0)
            $user = JWTAuth::parseToken()->authenticate();
        return User::all()->find($user);
    }

    /**
     *  Update a User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        if ($request->has('password')) {
            $user->update(array_merge(
                $request->all(),
                ['password' => bcrypt($request->password)]
            ));
        } else {
            $user->update($request->all());
        }

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Display a specified Item
     *
     * @param Int $user
     * @return Response
     */
    public function getItemsByUser(Int $user)
    {
        $account = User::findOrFail($user);

        return $account->item;
    }
}
