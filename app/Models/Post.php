<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;

    // add table columns inside the fillable array or just put empty guarded instead
    protected $guarded = [];

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
        return $query->where('is_vip', true)->with(['user', 'agency']);
    }

    public function scopeVipPostsByPeriod($query, $period) {
        return $query->whereDate('created_at', '>=', Carbon::today()->subMonths($period ? $period : 12))->with(['user', 'agency']);
    }

    public function scopeVoucherPosts($query) {
        return $query->where('has_voucher', true)->with(['user', 'agency']);
    }

    public function scopeAgencyPosts($query) {
        return $query->whereNotNull('agency_id')->where('realtor_type', '=', 'agent')->with(['user', 'agency']);
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
