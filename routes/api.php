<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('v1')
    ->group(function () {
        require __DIR__ . '/api/users.php';
        require __DIR__.'/api/posts.php';
        require __DIR__.'/api/comments.php';
    });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
