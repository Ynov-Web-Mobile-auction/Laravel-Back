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
     * Register a User.
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
