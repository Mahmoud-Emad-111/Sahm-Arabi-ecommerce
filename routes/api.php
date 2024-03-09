<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FactoryController;
use App\Http\Controllers\FactoryProductController;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletfactoryController;
use App\Http\Controllers\WalletshopController;
use App\Models\Shopproduct;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
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
          Route::post('Store_Comment','Store_Comment');
          Route::post('getComment','getComment');
          Route::post('logout','logout');
          });
          });
          // user Auth
          Route::controller(AuthController::class)->prefix('/Auth/')->group(function () {
          Route::post('register','register');
          Route::post('login','login');
          });



          // التاجر
          Route::controller(ShopController::class)->prefix('/Shop/')->group(function () {
          //register
          Route::post('registerShop' , 'registerShop');
          // Shop id get  التاجر
          Route::get('Get' , 'Get');
          Route::post('get_productShop', 'get_productShop');
          Route::get('Get_id' , 'Get_id');

          Route::get('get_wallet' , 'get_wallet');
          Route::get('get_products' , 'get_products');

          });


           // credit Shop
          Route::controller(WalletshopController::class)->prefix('/walletShop/')->group(function () {
          //store wallet
          Route::post('store', 'store');

          Route::get('Get', 'Get');


          });

          // المصنع
          Route::controller(FactoryController::class)->prefix('/factory/')->group(function () {
          //register
          Route::post('registerFactory' , 'registerFactory');

          Route::get('Get' , 'Get');
          Route::post('get_productFactory', 'get_productFactory');
          // Shop id get  المصنع
          Route::post('Get_id' , 'Get_id');

          Route::get('get_wallet/{id}' , 'get_wallet');
          Route::get('get_products' , 'get_products');

           });


         // credit Shop
          Route::controller(WalletfactoryController::class)->prefix('/walletfactory/')->group(function () {
          //store wallet
          Route::post('store', 'store');
          Route::get('Get', 'Get');

           });

          //category
          Route::controller(CategoryController::class)->prefix('/category/')->group(function () {
          Route::post('store','store');
          Route::get('Get','Get');
          Route::post('Get_id_allProducts','Get_id_allProducts');
          Route::post('Get_category_id', 'Get_category_id');

          });


           //product shop
           Route::controller(ShopProductController::class)->prefix('/productShop/')->group(function () {
            Route::post('store', 'store');
            Route::get('Get', 'Get');
            Route::post('Get_id', 'Get_id');

            // Route::post('Get_Comments', 'Get_Comments');

            });




           //product shop
           Route::controller(FactoryProductController::class)->prefix('/productfactory/')->group(function () {
            Route::post('store', 'store');
            Route::get('Get', 'Get');
            Route::post('Get_id', 'Get_id');

            // Route::post('Get_Comments', 'Get_Comments');

            });

          //Country
          Route::controller(CountryController::class)->prefix('/Country/')->group(function () {
          Route::post('store', 'store');
          Route::get('get_all', 'get_all');
          Route::post('getGoverenrate','getGoverenrate');

          });
          //Country
          Route::controller(GovernorateController::class)->prefix('/Governorate/')->group(function () {
          Route::post('store', 'store');
          Route::get('get_all', 'get_all');

          });



