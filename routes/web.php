<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $id = Auth::id();
    $check = Auth::check();
    $viaRemember = Auth::viaRemember();
    return view('dashboard', compact(
        'user',
        'id',
        'check',
        'viaRemember',
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/flights', function () {
    return response()->json([
        'hi' => Auth::user()->name
    ]);
})->middleware('auth');

Route::get('/direct-login', function(){
    // Auth::login(User::first());
    Auth::loginUsingId(2);
    return response()->json([
        'success' => true
    ]);
});


Route::get('/basic-auth', function () {
    return response() ->json(
        ['basic' =>  true] 
    );
})->middleware('auth.basic');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
