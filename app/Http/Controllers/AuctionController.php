<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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
     * @return Collection|Builder[]|Model
     */
    public function show(Auction $item)
    {
        return Auction::where('item_id', $item->id)->with('bids')->get();
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
