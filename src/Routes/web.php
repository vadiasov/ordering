<?php
//
//Route::namespace('Vadiasov\Ordering\Controllers')->as('ordering::')->middleware('web')->group(function () {
//    // Routes defined here have the web middleware applied
//    // like the web.php file in a laravel project
//    // They also have an applied controller namespace and a route names.
//
//    Route::middleware('ordering')->group(function () {
//        // Routes defined here have the self-assigned middleware applied.
//        // By default this middleware is empty.
//    });
//});


// src/Routes/web.php
Route::group(['middleware' => ['web']], function () {
    Route::get('/ordering/{config}/{id}', 'Vadiasov\Ordering\Controllers\OrderingController@index');
    Route::post('/ordering/{config}/{id}', 'Vadiasov\Ordering\Controllers\OrderingController@update');
});