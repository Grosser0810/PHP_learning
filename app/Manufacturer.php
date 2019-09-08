<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'manufacturer'
    ];


    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
