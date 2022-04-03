<?php

namespace App\Http\Controllers;

use Image;

use App\Category;
use App\Helpers\Helper;
use App\Helpers\ImageFilter;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    private $view;
    private $disk;
    private $pathFile;
    private $categories;
    private $configPage;
    
    public function __construct(Category $categories)
    {
        $this->middleware('auth');
        
        $this->categories = $categories;
        $this->view = 'categories';
        $this->configPage = 'categories';
        $this->pathFile = url('/storage');
        $this->disk = storage_path('app/public/');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pathFile = $this->pathFile;
        $configPage = $this->configPage;
        $categories = $this->categories->paginate(30);
        return view("{$this->view}.index", compact('categories', 'pathFile', 'configPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $configPage = $this->configPage;
        return view("{$this->view}.create", compact('configPage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image') && $request->image->isValid()) {
            $name = Helper::typeSlug($request->description).'-'.mt_rand(1, '36758');
            $image = "{$name}.{$request->file('image')->extension()}";
            $data['image'] = "images/categories/{$image}";
            // resizing an uploaded file
            $img = Image::make($request->file('image'));
            $img->filter(new ImageFilter("{$this->disk}{$data['image']}", 434, 529));
            $this->categories->create($data);
        }
        
        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = $this->categories->whereSlug($slug)->first();
    
        $configPage = $this->configPage;
        return view("{$this->view}.edit", compact('category', 'configPage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $slug)
    {
        $data = $request->all();
        $category = $this->categories->whereSlug($slug)->first();
    
        if ($request->hasFile('image') && $request->image->isValid()) {
            $name = Helper::typeSlug($request->description).'-'.mt_rand(1, '36758');;
            $image = "{$name}.{$request->file('image')->extension()}";
            $data['image'] = "images/categories/{$image}";
            // resizing an uploaded file
            $img = Image::make($request->file('image'));
            $img->filter(new ImageFilter("{$this->disk}{$data['image']}", 434, 529));
            
            $pathFile = $this->disk.$category->image;
            if (file_exists($pathFile)) {
                $remove = unlink($pathFile);
            }
        }
        if ($category->update($data)) {
            return redirect()->route('categorias.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $category = $this->categories->whereSlug($slug)->first();
        $products = $category->products;
        /**
         * Remover imagens da categoria
         */
        $fileCategory = $this->disk.$category->image;
        if (file_exists($fileCategory)) {
            $remove = unlink($fileCategory);
        }
        /**
         * Remover imagens do produto
         */
        if ($category->delete()) {
            if (count($products) >= 1) {
                foreach ($products as $product) {
                    $fileProduct = $this->disk.$product->image;
                    if (file_exists($fileProduct)) {
                        $remove = unlink($fileProduct);
                    }
                }
            }
        }
    
        return redirect()->route('categorias.index');
    
    }
}
