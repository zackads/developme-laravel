<?php

use App\Http\Controllers\API\Animals;
use App\Http\Controllers\API\Owners;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/owners", [Owners::class, "index"]);

Route::group(["prefix" => "owners"], function () {
    // GET /owners: show all Owners
    Route::get("", [Owners::class, "index"]);

    // POST /owners: create a new owner
    Route::post("", [Owners::class, "store"]);

    // all these routes also have an owner ID in the // end-point, e.g. /owners/8
    Route::group(["prefix" => "{owner}"], function () {
        // GET /Owners/8: show the Owner
        Route::get("", [Owners::class, "show"]);

        // PUT /Owners/8: update the Owner
        Route::put("", [Owners::class, "update"]);

        // DELETE /Owners/8: delete the owner
        Route::delete("", [Owners::class, "destroy"]);});
});

Route::group(["prefix" => "animals"], function () {
    Route::get("", [Animals::class, "index"]);

    Route::post("", [Animals::class, "store"]);

    Route::group(["prefix" => "{animal}"], function () {
        Route::get("", [Animals::class, "show"]);
        Route::put("", [Animals::class, "update"]);
        Route::delete("", [Animals::class, "destroy"]);});
});
