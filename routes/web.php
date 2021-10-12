<?php

use Illuminate\Support\Facades\App;
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
    return redirect()->route('apartments.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');



Route::get('/apartments/{apartment}/rooms/create', [
    \App\Http\Controllers\ApartmentController::class, 'createRoom'
])->name('apartments.rooms.create');
Route::resource('apartments', \App\Http\Controllers\ApartmentController::class);
Route::resource('tasks', \App\Http\Controllers\TaskController::class)
    ->middleware('auth');
Route::resource('tags', \App\Http\Controllers\TagController::class);
Route::get('tag/{slug}', [\App\Http\Controllers\TagController::class, 'showBySlug'])
    ->name('tags.slug');
Route::resource('rooms', \App\Http\Controllers\RoomController::class);
Route::resource('images', \App\Http\Controllers\ImageController::class);

require __DIR__.'/auth.php';

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'th'])) {
        abort(400);
    }

    session()->put('my_locale', $locale);

    return redirect()->back();
})->name('lang');

Route::get('/lang', function () {
    $locale = App::currentLocale();
    return $locale;
});

Route::get('/callback',
    [\App\Http\Controllers\GoogleAuthController::class, 'callback'])
   ->name('google.callback');

Route::get('/redirect',
    [\App\Http\Controllers\GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');
