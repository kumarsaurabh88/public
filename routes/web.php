<?php

use App\Models\Blog_catogries;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\BlockCustomerAccess;
use App\Http\Middleware\CheckPermission;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//starting template 2/5/2024
Route::get('/dashboard', [BlogController::class, 'index'])->name('dashboard');
Route::get('/add-blog', [BlogController::class, 'create'])->name('categories');
Route::post('/categories/store',[BlogController::class,'store'])->name('store');
Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog', [BlogController::class, 'blogslish'])->name('blogslish');
// Route::get('/blogs/{blogs}/edit',[BlogController::class,'edit'])->name('edit');
Route::get('blogs/{id}/edit', [BlogController::class, 'edit'])->name('edit');
Route::delete('/blogs/{blogs}', [BlogController::class, 'destroy'])->name('destroy');
Route::put('/blogs/{blogs}/update', [blogController::class, 'editupdate'])->name('editupdate');
Route::get('/contactus', [BlogController::class, 'contactus'])->name('contactus');
Route::get('/customer', [BlogController::class, 'customer'])->name('customer');
Route::post('/bulk-delete', [BlogController::class, 'bulkDelete'])->name('bulk-delete');



//this is author property 6-5-2024
Route::get('/add-author', [BlogController::class, 'createauthor'])->name('author');
Route::post('/author', [BlogController::class, 'storeauthor'])->name('author.store');
Route::get('/author-here', [BlogController::class, 'authorshow'])->name('authorshow');
Route::post('/authorlish', [BlogController::class, 'processAuthorlish'])->name('authorlish.process');
Route::get('/author/{id}/amend', [BlogController::class, 'amend'])->name('amend.author');
Route::put('/author/{id}', [BlogController::class, 'amendUpdate'])->name('update.author');
Route::delete('/author/{author}', [BlogController::class, 'remove'])->name('remove');




//this route use for makeblogCategories
Route::get('/add-category', [BlogController::class, 'createcat'])->name('blog.cat');
Route::post('/blogcat', [BlogController::class, 'storeblog'])->name('blogcat.store');
// Route::get('/bloglisht',[BlogController::class,'blogshow'])->name('blogshow');
Route::get('/category', [BlogController::class, 'blogshow'])->name('blogshow');
Route::post('/bloglisht', [BlogController::class, 'processBloglish'])->name('bloglisht.process');
Route::get('/category/{id}/modify', [BlogController::class, 'modify'])->name('modify.category');
Route::put('/category/{id}', [BlogController::class, 'modifyUpdate'])->name('update.category');
Route::delete('/category/{category}', [BlogController::class, 'deleteItem'])->name('deleteItem');


//this route use for tags
Route::get('/add-tag', [BlogController::class, 'createtag'])->name('tags');
Route::post('/tagcat', [BlogController::class, 'storetag'])->name('tag.store');
Route::get('/tag', [BlogController::class, 'tagshow'])->name('tagshow');
Route::post('/tagglisht', [BlogController::class, 'processtaglish'])->name('tagglisht.process');
Route::get('/tag/{id}/adjust', [BlogController::class, 'adjust'])->name('adjust.tag');
Route::put('/tag/{id}', [BlogController::class, 'adjustUpdate'])->name('update.tag');
Route::delete('/tag/{tag}', [BlogController::class, 'discard'])->name('discard');

//start routes for SEO
Route::get('/add-seo', [BlogController::class, 'make'])->name('seo');
Route::POST('/seosave', [BlogController::class, 'saveData'])->name('seo.store');
Route::get('/seo', [BlogController::class, 'seoshow'])->name('seoshow');
Route::post('/seolist', [BlogController::class, 'processSeolist'])->name('seolist.process');
Route::get('/seo/{id}/fillable', [BlogController::class, 'fillable'])->name('fillable.seo');
Route::put('/seo/{id}', [BlogController::class, 'seoUpdate'])->name('update.seo');
Route::delete('/seo/{seo}', [BlogController::class, 'undo'])->name('undo');

//start header
Route::get('/header', [BlogController::class, 'browse']);
Route::get('/footer', [BlogController::class, 'listall']);




Route::middleware([CustomerMiddleware::class])->group(function () {
    // Routes accessible only to authenticated customers
    Route::get('/blogs/dashboard', [blogController::class, 'customerDashboard'])->name('blogs.dashboard');

    Route::middleware([BlockCustomerAccess::class])->group(function () {
        // Routes accessible only to non-customer users
        Route::get('/auth/dashboard', [blogController::class, 'profile'])->name('blogs.dashboard');

        Route::resource('blogs', blogController::class);
        //this route for permisson
        // routes/web.php

        //   Route::get('/dashboard',[DashboardController::class,'index'])->middleware(CheckPermission::class . ':author','customer');

    });
});














Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
