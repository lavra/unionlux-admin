<?php

namespace App\Observers;

use App\Product as Model;
use App\Helpers\Helper;

class Product
{
    /**
     * Handle the permission "creating" event.
     *
     * @param  Model $product
     * @return void
     */
    public function creating(Model $product)
    {
        Helper::formatOrder($product);
        Helper::strSlug($product, $product->name);
    }
    
    /**
     * Handle the product "updating" event.
     *
     * @param  Model $product
     * @return void
     */
    public function updating(Model $product)
    {
        Helper::formatOrder($product);
        Helper::strSlug($product, $product->name);
    }
    
}
