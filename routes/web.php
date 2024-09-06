<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
    $auth = Auth::loginUsingId(1);

    return response()->json([
        'success' => true
    ]);
});


Route::post('login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('welcome');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
});


Route::post('/confirm-password', function (Request  $request){
    if(! \Illuminate\Support\Facades\Hash::check($request->password, $request->user()->password)){
        return back()->withErrors([
            'password' => 'Your current password is incorrect.',
        ]);
    }

    $request->session()->passwordConfirmed();

    return redirect()->intended();
})->middleware(['auth', 'throttle:6,1']);




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
