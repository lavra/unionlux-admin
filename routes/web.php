<?php

    use Illuminate\Support\Facades\Route;
    
    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */
    
    Route::get('/', function () {
        return view('auth.login');
    });
    
    
    Route::get('/home', 'HomeController@index')->name('home');
    // Home Content: Slider
    Route::post('home/slider', 'HomeController@sliderUpdate')->name('home.slider.update');
    
    // Users
    Route::resource('usuarios', 'UserController');
    Route::get('user/{id}/delete', 'UserController@destroy')->name('user.delete');

    // Categories
    Route::resource('categorias', 'CategoryController');
    Route::get('category/{id}/delete', 'CategoryController@destroy')->name('category.delete');
    
    // Products
    Route::resource('produtos', 'ProductController');
    Route::post('products/data', 'ProductController@dataTable')->name('products.data');
    Route::get('produto/{slug}/delete', 'ProductController@destroy')->name('product.delete');
    
    //Contact
    Route::resource('contatos', 'ContactController')->except(['create', 'store', 'show', 'destroy']);
    Route::post('contacts/data', 'ContactController@dataTable')->name('contacts.data');
    
    //NewsLetter
    Route::resource('newsletters', 'NewsletterController')->except(['create', 'store', 'show', 'destroy']);
    Route::post('newsletters/data', 'NewsletterController@dataTable')->name('newsletters.data');
    
    Auth::routes();
