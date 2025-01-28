<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function tours(){
        return $this->hasMany(Tour::class,'location_id');
    }
}
