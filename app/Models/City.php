<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable =[
        'region_id',
        'name'
    ];
    public function region() {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }
}
