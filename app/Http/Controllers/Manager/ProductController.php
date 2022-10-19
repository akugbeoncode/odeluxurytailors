<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Http\Resources\Product as ProductResource;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validator = $this->validate($request, [
        'name' => 'required|string|between:3,100',
        'code' => 'required|string',
        'category' => 'required|integer',
        'brand' => 'required|integer',
        'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
      ]);

      $product = Product::where('name', $request->name)->first();

      if ($product) {
        $data = [
          'message' => 'Product record with ' . $request->name . ' name already exist!',
          'status' => 403
        ];
        return response()->json($data, 403);
      }

      // Save Product Images later ...
      // something will happen here...

      $new_product = new Product();
      $new_product->name = htmlspecialchars($request->name);
      $new_product->generic_name = htmlspecialchars($request->generic_name);
      $new_product->code = htmlspecialchars($request->code);
      $new_product->category_id = htmlspecialchars($request->category);
      $new_product->brand_id = htmlspecialchars($request->brand);
      $new_product->unit_id = htmlspecialchars($request->product_unit);
      $new_product->purchase_unit_id = htmlspecialchars($request->purchase_unit);
      $new_product->sale_unit_id = htmlspecialchars($request->sale_unit);
      $new_product->has_inventory = $request->has_inventory ? 1 : 0;
      $new_product->is_active = $request->is_active ? 1 : 0;
      $new_product->product_meta = htmlspecialchars($request->product_meta);
      $new_product->product_details = $request->product_details;
      $new_product->unit_cost = htmlspecialchars($request->unit_cost_price);
      $new_product->unit_price = htmlspecialchars($request->unit_selling_price);
      $new_product->quantity_alert = htmlspecialchars($request->quantity_alert);

      if ($new_product->save()) {
        $data = [
          'message' => 'Product record was added successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Attempt to add product record failed!',
          'status' => 400
        ];
        return response()->json($data, 400);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return response()->json(
        Product::findOrFail($id), 
        200
      );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $targetProduct = Product::findOrFail($id);

      $validator = $this->validate($request, [
        'name' => 'required|string|between:3,100',
        'code' => 'required|string',
        'category' => 'required|integer',
        'brand' => 'required|integer',
        'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
      ]);

      $targetProduct->name = htmlspecialchars($request->name);
      $targetProduct->generic_name = htmlspecialchars($request->generic_name);
      $targetProduct->category_id = htmlspecialchars($request->category);
      $targetProduct->brand_id = htmlspecialchars($request->brand);
      $targetProduct->unit_id = htmlspecialchars($request->product_unit);
      $targetProduct->purchase_unit_id = htmlspecialchars($request->purchase_unit);
      $targetProduct->sale_unit_id = htmlspecialchars($request->sale_unit);
      $targetProduct->has_inventory = $request->has_inventory ? 1 : 0;
      $targetProduct->is_active = $request->is_active ? 1 : 0;
      $targetProduct->product_meta = htmlspecialchars($request->product_meta);
      $targetProduct->product_details = $request->product_details;
      $targetProduct->unit_cost = htmlspecialchars($request->unit_cost_price);
      $targetProduct->unit_price = htmlspecialchars($request->unit_selling_price);
      $targetProduct->quantity_alert = htmlspecialchars($request->quantity_alert);

      if ($targetProduct->save()) {
        $data = [
          'message' => 'Product record was updated successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Attempt to update product record failed!',
          'status' => 400
        ];
        return response()->json($data, 400);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $targetProduct = Product::findOrFail($id);
      // $images = $targetProduct->images;

      if ($targetProduct->delete()) {
        // Delete all product images

        return response()->json(['message' => 'Product was deleted successfully.'], 
          200
        );
      } else {
        return response()->json(['message' => 'Product delete attempt failed.'], 
          400
        );
      }
    }
}
