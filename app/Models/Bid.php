<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\AsPivot;

class Bid extends Model
{
    use HasFactory, AsPivot;

    public function auction() {
        return $this->belongsTo(Auction::class, 'auction_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     **/
    protected $fillable = [
        'user_id', 'auction_id', 'price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at', 'updated_at',
    ];
}
