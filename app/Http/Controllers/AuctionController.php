<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuctionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Auction::all();
    }

    /**
     * Display a specified Auction
     *
     * @param Item $item
     * @return JsonResponse
     */
    public function show(Item $item)
    {
        $auction = Auction::where('item_id', $item->id)->with('bids')->first();
        if ($auction) {
            return $auction;
        } else {
            return response()->json([
                'message' => 'Cette Item n\'est pas mis aux encheres',
            ], 204);
        }
    }

    /**
     * Create a new Auction associated to a Item
     *
     * @param Item $item
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Item $item, Request $request)
    {
        $auction = Auction::where('item_id', $item->id)->with('bids')->first();
        if ($auction) {
            return response()->json([
                'message' => 'Cette Item est deja au encheres',
            ], 401);
        }

        $user = JWTAuth::parseToken()->authenticate();
        if ($item->owner_id === $user->id) {
            $auction = Auction::create(array_merge($request->all(),
                ['item_id' => $item->id]
            ));
        } else {
            return response()->json([
                'message' => 'On ne touche pas ce qui ne nous appartient pas !',
            ], 401);
        }

        return response()->json([
            'message' => 'Auction successfully created',
            'Auction' => $auction
        ], 201);
    }
}
