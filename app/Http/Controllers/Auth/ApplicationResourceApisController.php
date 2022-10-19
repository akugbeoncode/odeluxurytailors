<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\UserRole;
use App\Models\Gender;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use App\Models\Product;

class ApplicationResourceApisController extends Controller
{
  public static function getCreateEmployeeAPIResource(Request $request) {
    return response()->json([
      'countries' => Country::all(),
      'states' => State::all(),
      'cities' => City::all(),
      'roles' => UserRole::all(),
      'managers' => User::getAllManagerGradeEmployees(),
      'employee_id' => User::getNewEmployeeID(),
      'genders' => Gender::all()
    ]);
  }

  public static function getAddCategoryAPIResource(Request $request) {
    return response()->json([
      'categories' => Category::all()
    ]);
  }

  public static function getAddProductAPIResource(Request $request) {
    return response()->json([
      'categories' => Category::all(),
      'brands' => Brand::where('is_active', 1)->get(),
      'units' => Unit::where('is_active', 1)->get()
    ]);
  }

  public static function generateProductCodeAPIResource(Request $request) {
    return response()->json([
      'product_code' => Product::generateProductCode()
    ]);
  }
}
