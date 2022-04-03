<?php

namespace App\Http\Controllers;

use Image;
use App\Slider;
use App\Helpers\Helper;
use App\Helpers\ImageFilter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $disk;
    private $slider;
    private $pathFile;
    private $configPage;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Slider $slider)
    {
        $this->middleware('auth');
        
        $this->configPage = 'home';
        $this->slider = $slider;
        $this->pathFile = url('/storage');
        $this->disk = storage_path('app/public/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = $this->slider->whereId(1)->first();
        $pathFile = $this->pathFile;

        $configPage = $this->configPage;
        return view('home.index', compact('configPage', 'pathFile', 'slider'));
    }
    
    /**
     * Altera imagem e textos do slider da home
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sliderUpdate(Request $request)
    {
        $data = $request->all();
        $slider = $this->slider->whereId(1)->first();
    
        if ($request->hasFile('image') && $request->image->isValid()) {
            $name = Helper::typeSlug($request->description).'-'.mt_rand(1, '12345');;
            $image = "{$name}.{$request->file('image')->extension()}";
            $data['image'] = "images/slider/{$image}";
            // resizing an uploaded file
            $img = Image::make($request->file('image'));
            $img->filter(new ImageFilter("{$this->disk}{$data['image']}", 434, 529));
        
            $pathFile = $this->disk.$slider->image;
            if (file_exists($pathFile)) {
                $remove = unlink($pathFile);
            }
        }
        if ($slider->update($data)) {
            return redirect()->route('home');
        }
    }
    
}
