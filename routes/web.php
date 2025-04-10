<?php

use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SliderController;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\PostController;
use App\Models\Posts;

Route::get('/', function () {

    $sliders = Slider::all();
    $testimonials = Testimonial::all();
    return view('frontend.home',compact('sliders','testimonials'));
});

Route::get('/about',function (){
    return view('frontend.about');
});

Route::get('/service',function (){
    return view('frontend.service');
})->middleware([TimeRestrictedAccess::class]);


Route::get('/blog',function (){
    $posts = Posts::orderBy('created_at','desc')->paginate(3);

    return view('frontend.blog',compact('posts'));
});

Route::get('/blog/{slug}', function ($slug) {
    $post = Posts::where('slug',$slug)->first();
    return view('frontend.post-single',compact('post'));
});



Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/SliderIndex','index')->name('slider.index');
    Route::post('/saveSlider','storeslider')->name('slider.store');
    Route::post('/sliderUpdate','updateslider')->name('slider.update');
    Route::get('/deleteSlider/{id}','deleteSlider')->name('slider.delete');
});

Route::get('/admin/dashboard', function () {
    if (!view()->exists('admin.dashboard')) {
        dd('View not found!');
    }
    return view('admin.dashboard');
});

Route::controller(SettingsController::class)->middleware(['auth','verified'])->group(function (){
  Route::get('/settings','index')->name('settings');
  Route::post('/settingsUpdate','update')->name('settings.update');
});

Route::controller(TestimonialController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/TestimonialIndex','index')->name('Testimonial.index');
    Route::post('/saveTestimonial','storeTestimonial')->name('Testimonial.store');
    Route::post('/TestimonialUpdate','updateTestimonial')->name('Testimonial.update');
    Route::get('/deleteTestimonial/{id}','deleteTestimonial')->name('Testimonial.delete');
});


Route::controller(PostController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/postIndex','index')->name('posts');
    Route::post('/savePost','storepost')->name('posts.store');
    Route::post('/postsUpdate','updatepost')->name('posts.update');
    Route::get('/deletePost/{id}','deletepost')->name('posts.delete');
  });

require __DIR__.'/auth.php';
