<?php

namespace App\Http\Controllers;

use App\Models\Item;
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

    /**
     * Update Item associated to a User
     *
     * @param Item $item
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Item $item, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $item = Item::find($item->id);
        if ($user->id === $item->owner->id) {
            $item->update($request->all());
        } else {
            return response()->json([
                'message' => 'On ne touche pas ce qui ne nous appartient pas !'
            ], 401);
        }

        return response()->json([
            'message' => 'Item successfully updated',
            'user' => $item
        ], 201);
    }
}
