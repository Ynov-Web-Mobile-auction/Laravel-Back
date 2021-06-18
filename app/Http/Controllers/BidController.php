<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class BidController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Bid::all();
    }

    /**
     * Display a specified Bid
     *
     * @param Bid $bid
     * @return Response
     */
    public function show(Bid $bid)
    {
        return Bid::all()->find($bid);
    }

    /**
     * Display a specified Bid
     *
     * @param Item $item
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllBidsOnItem(Item $item)
    {
        return Bid::with('auction')->get();
    }

    /**
     * Create a new Bid associated to a Item
     *
     * @param Auction $auction
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Auction $auction, Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $bid = Bid::create(array_merge($request->all(), [
            'item_id' => $auction->id,
            'user_id' => $user->id
        ]));

        return response()->json([
            'message' => 'Bid successfully created',
            'Bid' => $bid
        ], 201);
    }
}
