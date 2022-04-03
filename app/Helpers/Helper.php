<?php
    
    
namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    /**
     * Order dos Models
     * @param $model
     * @return mixed
     */
    public static function formatOrder($model)
    {
        $count = strlen($model->order);
        if ($count == 1) {
            $model->order = '0'.$model->order;
        }
        return $model;
    }
    
    /**
     * Slug para salvar nos Models
     * @param $model
     * @param $field
     * @return mixed
     */
    public static function strSlug($model, $field)
    {
        $model->slug = Str::slug($field);
        return $model;
    }
    
    /**
     * Get Sug
     * @param $str
     * @return string
     */
    public static function typeSlug($str)
    {
        return Str::slug($str);
    }
    
    
    public static function extFile($mime)
    {
        switch ($mime) {
            case "image/jpeg":
                $ext = ".jpg";
                break;
            case "image/png":
                $ext = ".png";
                break;
            case "image/gif":
                echo ".gif";
                break;
        }
    }
    
    
    
    
    
}