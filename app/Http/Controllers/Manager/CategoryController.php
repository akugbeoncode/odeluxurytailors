<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
     
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $output = new ConsoleOutput();

      $validator = $this->validate($request, [
        'name' => 'required|string|between:3,100',
        'parent_id' => 'required|integer',
        'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
      ]);

      $category = Category::where('name', $request->name)->first();

      if ($category) {
        $data = [
          'message' => 'Category record with ' . $request->name . ' name already exist!',
          'status' => 403
        ];
        return response()->json($data, 403);
      }

      $image_name = '';
      $destination = '/images/imageicon.png';

      $image = $request->file('file_upload');

      // $output->writeln('CONTENT TYPE ======>>>>>     ' . $request->content_type);

      if ($image) {
        $ext = $image->getClientOriginalExtension();
        $image_name = date("Ymdhis") . rand();
        $image_name = $image_name . "." . $image->getClientOriginalExtension();
        $destination = '/storage/images/uploads/categories/' . $image_name;
      }

      $new_category = new Category();

      $new_category->name = htmlspecialchars($request->name);
      $new_category->parent_id = htmlspecialchars($request->parent_id);
      $new_category->meta_name = htmlspecialchars($request->meta_name);
      $new_category->description = htmlspecialchars($request->description);
      $new_category->image = $destination;

      if ($new_category->save()) {
        if ($image) {
          $image->move(public_path('/storage/images/uploads/categories/'), $image_name);
        }
        $data = [
          'message' => 'Category record was added successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Attempt to add category record failed!',
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
        Category::findOrFail($id), 
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
      $targetCategory = Category::findOrFail($id);
      // $output = new ConsoleOutput();
      $currentImage = $targetCategory->image;
      $image_name = '';
      $destination = $targetCategory->image;

      $validator = $this->validate($request, [
        'name' => 'required|string|between:3,100',
        'parent_id' => 'required|integer',
        'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
      ]);

      $image = $request->file('file_upload');

      if ($image) {
        $ext = $image->getClientOriginalExtension();
        $image_name = date("Ymdhis") . rand();
        $image_name = $image_name . "." . $image->getClientOriginalExtension();
        $destination = '/storage/images/uploads/categories/' . $image_name;
      }

      $targetCategory->name = htmlspecialchars($request->name);
      $targetCategory->parent_id = htmlspecialchars($request->parent_id);
      $targetCategory->meta_name = htmlspecialchars($request->meta_name);
      $targetCategory->description = htmlspecialchars($request->description);
      $targetCategory->image = $destination;

      if ($targetCategory->save()) {
        if ($image) {
          Storage::disk('public')->delete($currentImage);
          $image->move(public_path('/storage/images/uploads/categories/'), $image_name);
        }
        $data = [
          'message' => 'Category record was update successfully.',
          'status' => 200
        ];
        return response()->json($data, 200);
      } else {
        $data = [
          'message' => 'Attempt to update category record failed!',
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
      $targetCategory = Category::findOrFail($id);
      $imageName = $targetCategory->image;

      if ($targetCategory->delete()) {
        if ($imageName != "/images/imageicon.png") {
          Storage::disk('public')->delete($imageName);
        }
        return response()->json(['message' => 'Category was deleted successfully.'], 
          200
        );
      } else {
        return response()->json(['message' => 'Category delete attempt failed.'], 
          400
        );
      }
    }
}
