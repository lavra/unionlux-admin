<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'active', 'order', 'image'];
    
    /**
     * Products
     * @return array
     **/
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
}



