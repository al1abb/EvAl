<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    // add table columns inside the fillable array
    protected $fillable = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function agency() {
        return $this->belongsTo(Agency::class);
    }

    public function flags() {
        return $this->hasMany(Flag::class);
    }

    public function scopeVipPosts($query) {
        return $query->where('is_vip', true);
    }

    public function scopeVoucherPosts($query) {
        return $query->where('has_voucher', true);
    }

    public function scopeSearch($query, $tradeType, $estateType, $roomCount, $city, $priceMin, $priceMax) {
        return $query
            ->whereIn('trade_type', $tradeType, 'and')
            ->whereIn('estate_type', $estateType, 'and')
            ->whereIn('room_count', $roomCount, 'and')
            ->whereIn('city', $city, 'and')
            ->where('price', '>=', $priceMin, 'and')
            ->where('price', '<=', $priceMax);
    }
}
