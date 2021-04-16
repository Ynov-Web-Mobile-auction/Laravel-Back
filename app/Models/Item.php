<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function owner() {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function auction(){
        return $this->belongsToMany(Auction::class, 'auctions')->withTimestamps();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     **/
    protected $fillable = [
        'name', 'details', 'creator', 'price', 'picture', 'status', 'owner_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at', 'updated_at'
    ];
}
