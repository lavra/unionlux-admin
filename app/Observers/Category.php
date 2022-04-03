<?php

namespace App\Observers;

use App\Category as Model;
use App\Helpers\Helper;

class Category
{
    /**
     * Handle the permission "creating" event.
     *
     * @param  Model $category
     * @return void
     */
    public function creating(Model $category)
    {
        Helper::formatOrder($category);
        Helper::strSlug($category, $category->description);
    }
    
    /**
     * Handle the category "updating" event.
     *
     * @param  Model $category
     * @return void
     */
    public function updating(Model $category)
    {
        Helper::formatOrder($category);
        Helper::strSlug($category, $category->description);
    }
    
}
