<?php
namespace App\Helpers;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class ImageFilter implements FilterInterface
{
    private $path;
    private $width;
    private $height;
    
    /**
     * Creates new instance of filter
     *
     * @param integer $size
     */
    public function __construct($path, $width, $height = null)
    {
        $this->path = $path;
        $this->width = $width;
        $this->height = $height;
    }
    
    /**
     * Applies filter effects to given image
     *
     * @param  Image $image
     * @return Image
     */
    public function applyFilter(Image $image)
    {
        $image->resize($this->width, $this->height)->save($this->path);
        return $image;
    }
}