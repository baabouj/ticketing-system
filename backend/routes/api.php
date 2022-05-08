<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request): User {
        return $request->user();
    });

    Route::prefix('users')->group(function () {
        Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
            Route::get("/", "index");
            Route::get("/{user}", "show");
            Route::delete("/{user}", "destroy");
        }
        );
    });
});

Route::prefix('auth')->group(function () {
    Route::controller(\App\Http\Controllers\AuthController::class)->group(function () {
        Route::post("/login", "login");
        Route::post("/signup", "signup");
        Route::post("/logout", "logout")->middleware('auth:sanctum');
    }
    );
});

Route::prefix('tickets')->group(function () {
    Route::controller(\App\Http\Controllers\TicketController::class)->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get("/", "index");
            Route::post("/", "store");
            Route::get("/{ticket}", "show");
            Route::put("/{ticket}", "update");
            Route::delete("/{ticket}", "destroy");
        });
    }
    );
});

Route::fallback(function () {
    return response([
        "message" => "Not Found",
    ], 404);
});
