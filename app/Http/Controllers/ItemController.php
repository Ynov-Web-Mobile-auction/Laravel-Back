<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Item::all();
    }

    /**
     * Display a specified Item
     *
     * @param  Item $item
     * @return Response
     */
    public function show(Item $item)
    {
        return Item::all()->find($item);
    }

    /**
     * Display all Item owned by the current user
     *
     * @param  User $user
     * @return Response
     */
    public function showByUser($user)
    {
        return Item::all()->where('owner_id', $user);
    }

    /**
     * Create a new Item associated to a User
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request) {
        $user = JWTAuth::parseToken()->authenticate();
        $item = Item::create(array_merge(
            $request->all(),
            ['owner_id' => $user->id]
        ));

        return response()->json([
            'message' => 'Item successfully created',
            'user' => $item
        ], 201);
    }
}
