<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'photo',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
