<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    // Other routes...
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

Route::get('/random', function() {
    $faker = Faker\Factory::create();
    return response()->json([
        'name' => $faker->name(),
        'email' => $faker->email(),
        'password' => $faker->password(8),
    ]);
});



