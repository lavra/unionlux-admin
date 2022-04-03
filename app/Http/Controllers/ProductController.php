<?php

namespace App\Http\Controllers;

use Image;
use App\Product;
use App\Category;
use App\Helpers\Helper;
use App\Helpers\ImageFilter;

use App\Http\Requests\ProductRequest;

use Illuminate\Http\Request;




class ProductController extends Controller
{
    private $view;
    private $disk;
    private $products;
    private $pathFile;
    private $categories;
    private $configPage;
    
    public function __construct(Category $categories, Product $products)
    {
        $this->middleware('auth');
        
        $this->products = $products;
        $this->categories = $categories;
        
        $this->view = 'products';
        $this->configPage = 'products';
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
        $configPage = $this->configPage;
        return view("{$this->view}.index", compact('configPage'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        $configPage = $this->configPage;
        return view("{$this->view}.create", compact('categories','configPage'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image') && $request->image->isValid()) {
            $name = Helper::typeSlug($request->name).'-'.mt_rand(1, '6789');
            $image = "{$name}.{$request->file('image')->extension()}";
            $data['image'] = "images/products/{$image}";
            // resizing an uploaded file
            $img = Image::make($request->file('image'));
            $img->filter(new ImageFilter("{$this->disk}{$data['image']}", 370));
            $this->products->create($data);
        }
        return redirect()->route('produtos.index');
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = $this->getCategories();
        $product = $this->products->whereSlug($slug)->first();
        $configPage = $this->configPage;
        return view("{$this->view}.edit", compact('product', 'categories','configPage'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $slug)
    {
        $data = $request->all();
        $product = $this->products->whereSlug($slug)->first();
        
        if ($request->hasFile('image') && $request->image->isValid()) {
            
            $pathFile = $this->disk.$product->image;
            if (file_exists($pathFile)) {
                $remove = unlink($pathFile);
            }
    
            $name = Helper::typeSlug($request->name).'-'.mt_rand(1, '6789');;
            $image = "{$name}.{$request->file('image')->extension()}";
            $data['image'] = "images/products/{$image}";
            // resizing an uploaded file
            $img = Image::make($request->file('image'));
            $img->filter(new ImageFilter("{$this->disk}{$data['image']}", 370));
    
        }
        if ($product->update($data)) {
            return redirect()->route('produtos.index');
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
        $product = $this->products->whereSlug($slug)->first();
        
        if ($product->delete()) {
            $pathFile = $this->disk.$product->image;
            
            if (file_exists($pathFile)) {
                $remove = unlink($pathFile);
            }
            return redirect()->route('produtos.index');
        }
    }
    
    /**
     * Get Products
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataTable(Request $request)
    {
        $columns = array(
            
            0  => 'image',
            1 =>  'id',
            2  => 'name',
            3  => 'category_id',
            4  => 'description',
            5  => 'active',
        );
        
        $totalData = $this->products->count();
        $totalFiltered = $totalData;
    
        
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir   = $request->input('order.0.dir');
        
        
        if (empty($request->input('search.value'))) {
            $query = $this->products
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        } else {
            $search = $request->input('search.value');
            
            $query =  $this->products->where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
            
            
            
            $totalFiltered = $this->products->where('id','LIKE',"%{$search}%")
                ->orWhere('name', 'LIKE',"%{$search}%")
                ->orWhere('description', 'LIKE',"%{$search}%")
                ->count();
        }
        
        $data  = array();
        if(!empty($query))
        {
            foreach ($query as $post){
    
                $post->active == 1 ? $active ='<i class="fa fa-check text-success"></i> Ativo' : $active ='<i class="fa fa-check text-danger"></i> Inativo';
                $actions = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $actions .= '<a href="'.route('product.delete', $post->slug).'" class="remove btn btn-danger"><i class="fa fa-trash"></i></button>';
                    $actions .= '<a href="'.route('produtos.edit', $post->slug).'" class="edit btn btn-info"><i class="fa fa-pencil-square-o"></i></button>';
                $actions .= '</div>';
    
                $nData['image']        = '<img src="'.$this->pathFile.'/'.$post->image.'" width="50px">';
                $nData['id']           = $post->id;
                $nData['name']         = $post->name;
                $nData['category_id']  = $post->category->name ??  '';
                $nData['description']  = $post->description;
                $nData['active']       = $active;
                $nData['actions']      = $actions;
                $data[] = $nData;
            }
        }
        
        $out = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
    
        return response()->json($out);
    }
    
    /**
     * Get todas categories.
     *
     * @return array
     */
    public function getCategories()
    {
        return $this->categories->orderBy('name')->where('active', 1)->pluck('name','id');
    }
}
