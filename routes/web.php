<?php

use App\Exceptions\InvalidOrderException;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/payments', function () {

    $users = collect(Http::get('https://jsonplaceholder.typicode.com/posts')->json())->map(fn($post)=> $post['title']);
    return $users;

})->middleware(['auth', 'password.confirm'])->name('account.payments');

require __DIR__.'/auth.php';


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/endpoint', function () {
    return Process::run('fdajkfld;a fda')->errorOutput();
});
