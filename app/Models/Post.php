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

    public function image() {
        return $this->hasMany(PostImage::class);
    }

    public function scopeVipPosts($query) {
        return $query->where('is_vip', true)->with(['user', 'agency']);
    }

    public function scopeVipPostsByPeriod($query, $period) {
        return $query->where('is_vip', true)->whereDate('created_at', '>=', Carbon::today()->subMonths($period ? $period : 12))->with(['user', 'agency']);
    }

    public function scopeVoucherPosts($query) {
        return $query->where('has_voucher', true)->with(['user', 'agency']);
    }

    public function scopeAgencyPosts($query) {
        return $query->whereNotNull('agency_id')->where('realtor_type', '=', 'agent')->with(['user', 'agency']);
    }

    public function scopeSearch($query, $tradeType, $estateType, $roomCount, $city, $priceMin, $priceMax, $areaMin, $areaMax, $floorMin, $floorMax, $vipChecked, $agencyChecked) {
        if($tradeType) {
            $query->whereIn('trade_type', $tradeType, 'and');
        }
        if($estateType) {
            $query->whereIn('estate_type', $estateType, 'and');
        }
        if($roomCount) {
            if($roomCount=='5+') {
                $query->where('room_count', '>=', 5, 'and');
            }
            else if($roomCount=='Hamısı') {
                $query->where('room_count', '>=', 0, 'and');
            }
            else {
                $query->whereIn('room_count', $roomCount, 'and');
            }
        }
        if($city) {
            $query->whereIn('city', $city, 'and');
        }
        if($priceMin) {
            $query->where('price', '>=', $priceMin);
        }
        if($priceMax) {
            $query->where('price', '<=', $priceMax);
        }
        if($areaMin) {
            $query->where('area', '>=', $areaMin);
        }
        if($areaMax) {
            $query->where('area', '<=', $areaMax);
        }
        if($floorMin) {
            $query->where('apartment_floor', '>=', $floorMin);
        }
        if($floorMax) {
            $query->where('apartment_floor', '<=', $floorMax);
        }
        if($vipChecked) {
            $query->where('is_vip', $vipChecked);
        }
        if($agencyChecked) {
            $query->whereNotNull('agency_id')->where('realtor_type', 'agent');
        }
        return $query;
            
            
            
            
            // ->whereBetween('price', [$priceMin, $priceMax], 'and')
            // ->whereBetween('area', [$areaMin, $areaMax], 'and')
            // ->whereBetween('apartment_floor', [$floorMin, $floorMax], 'and')
            // ->where('is_vip', $vipChecked)
            // ->where('agency_id', );
    }
}
