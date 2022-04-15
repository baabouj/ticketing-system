<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::prefix('auth')->group(function () {
    Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {

        Route::post("/login", "login");

        Route::post("/signup", "signup");

        Route::get("/logout", "logout")->middleware('auth:sanctum');
    }
    );

});

Route::fallback(function () {
    return response([
        "message" => "Not Found",
    ], 404);
});
