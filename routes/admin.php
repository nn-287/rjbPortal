<?php


use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DeliveryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\DriverController;

Route::group(['namespace' => 'Admin', 'as' => 'admin.'], function () 
{
    /*authentication*/
    Route::group(['namespace' => 'Auth', 'prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('login');
        Route::post('login', [LoginController::class, 'submit']);
        
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('home-page', [LoginController::class, 'home_page'])->name('home-page');
        
    });




    Route::group(['middleware' => ['admin']], function () 
    {
        Route::get('/', [SystemController::class, 'dashboard'])->name('dashboard');


        Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
            Route::get('list/{status}', [OrderController::class, 'list'])->name('list');
            Route::get('details/{id}', [OrderController::class, 'details'])->name('details');
            Route::get('status', [OrderController::class, 'UpdateOrderStatus'])->name('status');
            Route::get('payment-status', [OrderController::class, 'payment_status'])->name('payment-status');
            Route::delete('delete-order/{id}', [OrderController::class, 'delete_order'])->name('delete-order');
            Route::post('search', [OrderController::class, 'search'])->name('search');
        });

        

        Route::group(['prefix' => 'delivery', 'as' => 'delivery.'], function () {
            Route::get('list', [DeliveryController::class, 'ListDeliveries'])->name('list');
            Route::delete('delete/{id}', [DeliveryController::class, 'RemoveDelivery'])->name('delete');
            Route::post('search', [DeliveryController::class, 'search'])->name('search');
        });



        Route::group(['prefix' => 'driver', 'as' => 'driver.'], function () {
            Route::get('list', [DriverController::class, 'ListDriver'])->name('list');
            Route::get('add-new', [DriverController::class, 'Addnew'])->name('add-new');
            Route::post('store', [DriverController::class, 'store'])->name('store');
            Route::get('edit/{id}', [DriverController::class, 'edit'])->name('edit');
            Route::put('update/{id}', [DriverController::class, 'update'])->name('update');
            Route::post('search', [DriverController::class, 'search'])->name('search');
            Route::delete('delete/{id}', [DriverController::class, 'RemoveDriver'])->name('delete');
        });




    });
  
});
