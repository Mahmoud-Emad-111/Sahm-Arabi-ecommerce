<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\GovernorateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletfactoryController;
use App\Http\Controllers\WalletshopController;

/*
|--------------------------------------------------------------------------
|Dashboard API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
          // user
          Route::group(['middleware'=> 'auth:sanctum'], function(){
          Route::controller(UserController::class)->prefix('/user/')->group(function () {
          Route::post('users','index');
          Route::post('Get_id','Get_id');
          Route::post('edit','edit');
          Route::post('Update','Update');
          Route::post('delete','delete');
          Route::post('Store_Comment','Store_Comment');
          Route::post('getComment','getComment');
          Route::post('logout','logout');
          });
          });

          //Admin
          Route::group(['middleware'=> 'auth:sanctum'], function(){
          Route::controller(AdminController::class)->prefix('/Admin/')->group(function () {
          Route::get('Get','index');
          Route::post('edit','edit');
          Route::post('Update','Update');
          Route::post('approveshop','approveshop');
          Route::post('rejectShop','rejectShop');
          Route::post('logout','logout');
          });
          });
          // Admin Auth
          Route::controller(AuthAdminController::class)->prefix('/AuthAdmin/')->group(function (){
          Route::post('login', 'checklogin');
          });

          // التاجر
          Route::controller(ShopController::class)->prefix('/Shop/')->group(function () {
          // Shop id get  التاجر
          Route::get('Get' , 'Get');

          Route::post('Get_id' , 'Get_id');

          Route::post('edit' , 'edit');
          //update info data
          Route::post('update', 'update');
          // Delete//
          Route::post('delete','delete');
        //   // get relation shop crdit card
        //   Route::post('get_credit' , 'get_credit');
          // get relation shop wallet
          Route::get('get_wallet/{id}' , 'get_wallet');
        //   Route::get('get_products/{id}' , 'get_products');

          });

        //   // credit Shop
        //   Route::controller(creditshopController::class)->prefix('/creditShop/')->group(function () {
        //   //store credit card
        //   Route::post('store', 'store');

        //   Route::post('Get', 'Get');
        //   //update info data
        //   Route::post('update', 'update');
        //   // Delete//
        //   Route::post('delete','delete');
        //   });

           // credit Shop
          Route::controller(WalletshopController::class)->prefix('/walletShop/')->group(function () {
          //store wallet
          Route::post('store', 'store');

          Route::get('Get', 'Get');
          //update info data
          Route::post('update', 'update');
          // Delete//
          Route::post('delete','delete');
          });

          // المصنع
          Route::controller(FactoryController::class)->prefix('/factory/')->group(function () {
          //register
          Route::post('registerFactory' , 'registerFactory');

          Route::get('Get' , 'Get');

          // Shop id get  المصنع
          Route::post('Get_id' , 'Get_id');
          Route::post('get_productFactory' , 'get_productFactory');


        //   // get relation shop crdit card
        //   Route::post('get_credit' , 'get_credit');
          // get relation shop wallet
          Route::post('get_wallet' , 'get_wallet');
          //update info data
          Route::post('update', 'update');
          //    delete
          Route::post('delete','delete');
           });

        //      // credit Shop
        //   Route::controller(creditfactoryController::class)->prefix('/creditfactory/')->group(function () {
        //     //store credit card
        //   Route::post('store', 'store');
        //    //update info data
        //   Route::post('update', 'update');
        //    // Delete//
        //   Route::post('delete','delete');
        //    });

         // credit Shop
          Route::controller(WalletfactoryController::class)->prefix('/walletfactory/')->group(function () {
          //store wallet
          Route::post('store', 'store');
          Route::get('Get', 'Get');
           //update info data
          Route::post('update', 'update');
           // Delete//
          Route::post('delete','delete');
           });

          //category
          Route::controller(CategoryController::class)->prefix('/category/')->group(function () {
          Route::post('store','store');
          Route::get('Get','Get');

          Route::post('Get_id_allProducts','Get_id_allProducts');
          Route::post('Get_category_id', 'Get_category_id');
          //update info data
          Route::post('update', 'update');
          // Delete//
          Route::post('delete','delete');
          });

            //product shop
            Route::controller(ShopProductController::class)->prefix('/productShop/')->group(function () {
                Route::post('store', 'store');
                Route::get('Get', 'Get');
                Route::post('Get_id', 'Get_id');

                // Route::post('Get_Comments', 'Get_Comments');
                //update info data
                Route::post('update', 'update');
                // Delete//
               Route::post('delete','delete');
                });


          //Country
          Route::controller(CountryController::class)->prefix('/Country/')->group(function () {
          Route::post('store', 'store');
          Route::get('get_all', 'get_all');
          Route::post('getGoverenrate','getGoverenrate');
          //update info data
          Route::post('update', 'update');
          // Delete//
          Route::post('delete','delete');
          });
          //Country
          Route::controller(GovernorateController::class)->prefix('/Governorate/')->group(function () {
          Route::post('store', 'store');
          Route::get('get_all', 'get_all');
          //update info data
          Route::post('update', 'update');
          // Delete//
          Route::post('delete','delete');
          });



