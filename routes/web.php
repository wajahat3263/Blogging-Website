<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\Home\BlogCatagoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
    // return view('welcome');
    // return view('frontend.index');
// });

///======== routes ========///
Route::controller(DemoController::class)->group(function(){
    // url-------method----route_name
    Route::get('/', 'Home')->name('home');

});


///======== admin all routes ========///
Route::middleware(['auth'])->group(function () {

    Route::controller(AdminController::class)->group(function(){
        // url------------method---------route_name
        Route::get('/admin/logout', 'destroy')->name('admin.logout');
        Route::get('/admin/profile', 'Profile')->name('admin.profile');
        Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
        Route::post('/store/profile', 'StoreProfile')->name('store.profile');

        Route::get('/change/password', 'ChangePassword')->name('change.password');
        Route::post('/update/password', 'UpdatePassword')->name('update.password');

    });

});

///======== Home slide all routes ========///
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slide');
    Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
   
});

///======== About page all routes ========///
Route::controller(AboutController::class)->group(function(){
    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    Route::get('/about', 'HomeAbout')->name('home.about');
    
    Route::get('/about/images', 'AboutImages')->name('about.images'); //multi_image page
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image'); //store multi_image
    Route::get('/all/about/images', 'AllAboutImages')->name('all.about.images'); //display multi_image
    Route::get('/edit/multi/image/{eid}', 'EditMultiImage')->name('edit.multi.image'); //edit multi_image
    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image'); //update multi_image
    Route::get('/delete/multi/image/{did}', 'DeleteMultiImage')->name('delete.multi.image'); //delete multi_image
   
});

///======== Portfolio all routes ========///
Route::controller(PortfolioController::class)->group(function(){
    Route::get('/add/portfolio', 'AddPortfolio')->name('add.portfolio');
    Route::post('/store/portfolio', 'StorePortfolio')->name('store.portfolio');
    Route::get('/all/portfolio', 'AllPortfolio')->name('all.portfolio');
    Route::get('/edit/portfolio/{eid}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portfolio', 'UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portfolio/{did}', 'DeletePortfolio')->name('delete.portfolio');

    // frontend
    Route::get('/portfolio/details/{pid}', 'PortfolioDetails')->name('portfolio.details');
    Route::get('/portfolio/page', 'PortfolioPage')->name('portfolio.page');
   
});

///======== BlogCatagory all routes ========///
Route::controller(BlogCatagoryController::class)->group(function(){
    Route::get('/add/blog/catagory', 'AddBlogCatagory')->name('add.blog.catagory');
    Route::post('/store/blog/catagory', 'StoreBlogCatagory')->name('store.blog.catagory');
    Route::get('/all/blog/catagory', 'AllBlogCatagory')->name('all.blog.catagory');
    Route::get('/edit/blog/catagory/{eid}', 'EditBlogCatagory')->name('edit.blog.catagory');
    Route::post('/update/blog/catagory', 'UpdateBlogCatagory')->name('update.blog.catagory');
    Route::get('/delete/blog/catagory/{did}', 'DeleteBlogCatagory')->name('delete.blog.catagory');
   
});

//======== Blog all routes ========///
Route::controller(BlogController::class)->group(function(){
    Route::get('/add/blog', 'AddBlog')->name('add.blog');
    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/edit/blog/{eid}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{did}', 'DeleteBlog')->name('delete.blog');

    Route::get('/blog/details/{bid}', 'BlogDetails')->name('blog.details');
    Route::get('/catagory/post/{cid}', 'CatagoryPost')->name('catagory.post');
    Route::get('/blogs/all', 'BlogsAll')->name('blogs.all');
   
});

///======== Footer all routes ========///
Route::controller(FooterController::class)->group(function(){
    Route::get('/footer', 'Footer')->name('footer');
    Route::post('/update/footer', 'UpdateFooter')->name('update.footer');
   
});

///======== Contact all routes ========///
Route::controller(ContactController::class)->group(function(){
    // frontend
    Route::get('/contact/page', 'ContactPage')->name('contact.page');
    Route::post('/store/message', 'StoreMessage')->name('store.message');
    // backend
    Route::get('/contact/message', 'ContactMessage')->name('contact.message');
    Route::get('/delete/message/{did}', 'DeleteMessage')->name('delete.message');
   
});













Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
