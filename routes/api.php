<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Manager\EmployeesController;
use App\Http\Controllers\Manager\CategoryController;
use App\Http\Controllers\Manager\BrandController;
use App\Http\Controllers\Manager\UnitController;
use App\Http\Controllers\Manager\ProductController;
use App\Http\Controllers\Manager\ProductVariantController;
use App\Http\Controllers\Auth\ApplicationResourceApisController;
use App\Http\Controllers\LoggedUserProfileController;

Route::group([ 'middleware' => 'api', 'prefix' => 'v1/auth' ], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

Route::group([ 'middleware' => 'api', 'prefix' => 'v1/managers' ], function () {
    Route::apiResource('employees', EmployeesController::class);
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('brands', BrandController::class);
    Route::apiResource('units', UnitController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product-variants', ProductVariantController::class);
});

Route::group([ 'middleware' => 'api', 'prefix' => 'v1' ], function () {
    Route::get('employee-account-resources', [ApplicationResourceApisController::class, 'getCreateEmployeeAPIResource']);
    Route::get('category-resources', [ApplicationResourceApisController::class, 'getAddCategoryAPIResource']);
    Route::get('product-resources', [ApplicationResourceApisController::class, 'getAddProductAPIResource']);
    Route::get('generate-product-code', [ApplicationResourceApisController::class, 'generateProductCodeAPIResource']);
});

Route::group([ 'middleware' => 'api', 'prefix' => 'v1' ], function () {
    Route::put('/user-profile/{id}/update-logged-user-record', [LoggedUserProfileController::class, 'updateLoggedUserRecord'])-> name('loggeduser.edit_profile');
    Route::put('/user-profile/{id}/changed-logged-user-password', [LoggedUserProfileController::class, 'changeLoggedUserPassword'])-> name('loggeduser.change_password');
    Route::put('/user-profile/{id}/changed-logged-user-profile-image', [LoggedUserProfileController::class, 'changeLoggedUserProfilePhoto'])-> name('loggeduser.change_image');
    Route::post('/user-profile/{id}/reset-employee-password', [LoggedUserProfileController::class, 'resetEmployeePassword'])-> name('loggeduser.reset_employee_password');
});

