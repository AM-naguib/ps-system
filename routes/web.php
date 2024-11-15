<?php

use App\Http\Controllers\TimerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Panel\ItemController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\DeviceController;
use App\Http\Controllers\Panel\WorkerController;
use App\Http\Controllers\Panel\SettingController;
use App\Http\Controllers\Panel\CustomerController;
use App\Http\Controllers\Panel\Auth\LoginController;

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


Route::controller(PanelController::class)->prefix("panel")->name("panel.")->middleware('auth.both')->group(function () {
    Route::get("/", "index");
    Route::get("/index", "index")->name("index");

    Route::resource("workers", WorkerController::class)->except("show","create","edit");
    Route::get("workers/{id}", [WorkerController::class,"getWorker"])->name("workers.getWorker");

    Route::resource("devices", DeviceController::class)->except("show","create","edit");
    Route::get("devices/{id}", [DeviceController::class,"getDevice"])->name("devices.getDevice");

    Route::resource("items", ItemController::class)->except("show","create","edit");
    Route::get("items/{id}", [ItemController::class,"getItem"])->name("items.getItem");

    Route::resource("customers", CustomerController::class)->except("show","create","edit");
    Route::get("customers/{id}", [CustomerController::class,"getCustomer"])->name("customers.getCustomer");

    Route::get("settings",[SettingController::class,"index"])->name("settings.index");
    Route::post("settings",[SettingController::class,"store"])->name("settings.store");

});



Route::controller(TimerController::class)->prefix("timer")->middleware('auth.both')->name("timer.")->group(function () {
    Route::get("/", "index")->name("index");
});

Route::controller(LoginController::class)->name("login.")->middleware("guest")->group(function () {
    Route::get("login", "index")->name("index");
    Route::post("/login", "store")->name("store");
});

