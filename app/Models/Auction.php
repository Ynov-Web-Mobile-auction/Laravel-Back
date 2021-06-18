<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsToMany(User::class, 'users')->withTimestamps();
    }

    public function item() {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function bids() {
        return $this->hasMany(Bid::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     **/
    protected $fillable = [
        'item_id', 'duration', 'status'
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
