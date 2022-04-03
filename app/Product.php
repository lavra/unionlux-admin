<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'order',
        'price',
        'active'
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
