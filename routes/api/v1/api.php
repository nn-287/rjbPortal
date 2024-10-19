<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\CustomerAuthController;
use App\Http\Controllers\Api\V1\Auth\DriverAuthController; 
use App\Http\Controllers\Api\V1\Auth\CustomerPasswordResetController;
use App\Http\Controllers\Api\V1\Auth\DriverPasswordResetController;


use App\Http\Controllers\Api\V1\DeliveryController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\PaymentController; 


Route::group(['namespace' => 'Api\V1'], function () {



    Route::post('loginuser', [CustomerAuthController::class, 'loginUser']);

    Route::post('logindriver', [DriverAuthController::class, 'loginDriver']);
    
    

    Route::middleware(['auth:user-api'])->group(function() {

        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () { 

            Route::post('user-forgot-password', [CustomerPasswordResetController::class, 'reset_password_request']);
            Route::post('user-verify-token', [CustomerPasswordResetController::class, 'verify_token']);
            Route::post('user-reset-password', [CustomerPasswordResetController::class, 'reset_password_submit']);
    
    
            Route::get('user-show-profile', [CustomerAuthController::class, 'viewProfile']);
            Route::post('user-update-profile', [CustomerAuthController::class, 'update']);
        });
    
    });



    Route::middleware(['auth:driver-api'])->group(function() {

        Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () { 
    
            Route::post('driver-forgot-password', [DriverPasswordResetController::class, 'reset_password_request']);
            Route::post('driver-verify-token', [DriverPasswordResetController::class, 'verify_token']);
            Route::post('driver-reset-password', [DriverPasswordResetController::class, 'reset_password_submit']);
        
    
            Route::get('driver-show-profile', [DriverAuthController::class, 'viewProfile']);//DONE
            Route::post('driver-update-profile', [DriverAuthController::class, 'update']);//DONE
        });
    
    });




    Route::group(['prefix' => 'earnings'], function () {

        Route::get('previous-month-earnings', [DriverAuthController::class, 'getLastMonthEarnings']);//DONE

        Route::get('total-earnings', [DriverAuthController::class, 'getTotalEarnings']);

        Route::get('add-earnings', [DriverAuthController::class, 'addEarnings']);

        Route::get('list-earnings', [DriverAuthController::class, 'listEarnings']);
    });





    Route::group(['prefix' => 'statistics'], function () {

        Route::get('status-count', [DeliveryController::class, 'getStatistics']);

        Route::get('successful-deliveries-insights', [DeliveryController::class, 'successfulDeliveries']);

        Route::post('list-delivery-status', [DeliveryController::class, 'deliveryStatus']);

        Route::get('delivery-details', [DeliveryController::class, 'deliveryDetail']);
    });





    Route::group(['prefix' => 'invoice'], function () {

        Route::post('invoice-details', [InvoiceController::class, 'invoiceDetail']);
    });




    Route::group(['prefix' => 'payment'], function () {

        Route::post('payment-request', [PaymentController::class, 'requestPayment']);
    });

});