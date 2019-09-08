<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'image', 'stock', 'code', 'description', 'price', 'composition', 'group_id', 'manufacturer_id'];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
