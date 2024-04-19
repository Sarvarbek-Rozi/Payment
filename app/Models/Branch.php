<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'photo',
        'brand_id',
        'region_id',
        'city_id'
    ];


    public function brand()
    {
        return $this->belongsTo('App\Models\Brand','brand_id');
    }
    public function region()
    {
        return $this->belongsTo('App\Models\Region','region_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }
}
