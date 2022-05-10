<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route
        ::prefix('users')->group(function () {
            Route
                ::controller(UserController::class)->group(function () {
                    Route::get("/", "index");
                    Route::get("/{user}", "show");
                    Route::delete("/{user}", "destroy");
                    Route::get('/{user}/tickets', "tickets");
                }
                );
        });
});

Route
    ::prefix('auth')->group(function () {
        Route
            ::controller(AuthController::class)->group(function () {
                Route::post("/login", "login");
                Route::post("/signup", "signup");
                Route::post("/logout", "logout")->middleware('auth:sanctum');
            }
            );
    });

Route
    ::prefix('tickets')->group(function () {
        Route
            ::middleware('auth:sanctum')->group(function () {
                Route
                    ::controller(TicketController::class)->group(function () {
                        Route::get("/", "index");
                        Route::post("/", "store");
                        Route::get("/{ticket}", "show");
                        Route::put("/{ticket}", "update");
                        Route::delete("/{ticket}", "destroy");
                    });

                Route
                    ::controller(CommentController::class)->group(function () {
                        Route::get("/{ticket}/comments", "index");
                        Route::post("/{ticket}/comments", "store");
                    });
            });
    });

Route
    ::prefix('comments')->group(function () {
        Route
            ::middleware('auth:sanctum')->group(function () {
                Route
                    ::controller(CommentController::class)->group(function () {
                        Route::get("/{comment}", "show");
                        Route::put("/{comment}", "update");
                        Route::delete("/{comment}", "destroy");
                    });
            });
    });

Route::fallback(function () {
    return response([
        "message" => "Not Found",
    ], 404);
});
