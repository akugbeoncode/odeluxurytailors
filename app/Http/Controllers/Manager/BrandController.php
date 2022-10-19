<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Http\Resources\Brand as BrandResource;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $brands = Brand::where('is_active', 1)->get();
        $brands = Brand::all();
     
        return BrandResource::collection($brands);
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
            'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        $brand = Brand::where('name', $request->name)->first();

        if ($brand) {
            $data = [
            'message' => 'Brand record with ' . $request->name . ' name already exist!',
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
            $image_name = $request->name . '_logo';
            $image_name = $image_name . "." . $image->getClientOriginalExtension();
            $destination = '/storage/images/uploads/brands/' . $image_name;
        }

        $new_brand = new Brand();

        $new_brand->name = htmlspecialchars($request->name);
        $new_brand->is_active = $request->is_active ? 1 : 0;
        $new_brand->description = htmlspecialchars($request->description);
        $new_brand->image = $destination;

        if ($new_brand->save()) {
            if ($image) {
            $image->move(public_path('/storage/images/uploads/brands/'), $image_name);
            }
            $data = [
            'message' => 'Brand record was added successfully.',
            'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            $data = [
            'message' => 'Attempt to add brand record failed!',
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
            Brand::findOrFail($id), 
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
        $targetBrand = Brand::findOrFail($id);
        $output = new ConsoleOutput();
        $currentImage = $targetBrand->image;
        $image_name = '';
        $destination = $targetBrand->image;


        $validator = $this->validate($request, [
          'name' => 'required|string|between:3,100',
          'file_upload' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        $image = $request->file('file_upload');

        if ($image) {
          $ext = $image->getClientOriginalExtension();
          $image_name = $request->name . '_logo';
          $image_name = $image_name . "." . $image->getClientOriginalExtension();
          $destination = '/storage/images/uploads/brands/' . $image_name;
        }

        $targetBrand->name = htmlspecialchars($request->name);
        $targetBrand->is_active = $request->is_active ? 1 : 0;
        $targetBrand->description = htmlspecialchars($request->description);
        $targetBrand->image = $destination;

        if ($targetBrand->save()) {
          if ($image) {
            Storage::disk('public')->delete($currentImage);
            $image->move(public_path('/storage/images/uploads/brands/'), $image_name);
          }
          $data = [
            'message' => 'Brand record was update successfully.',
            'status' => 200
          ];
          return response()->json($data, 200);
        } else {
          $data = [
            'message' => 'Attempt to update brand record failed!',
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
        $targetBrand = Brand::findOrFail($id);
        $imageName = $targetBrand->image;

        if ($targetBrand->delete()) {
            if ($imageName != "/images/imageicon.png") {
            Storage::disk('public')->delete($imageName);
            }
            return response()->json(['message' => 'Brand was deleted successfully.'], 
            200
            );
        } else {
            return response()->json(['message' => 'Brand delete attempt failed.'], 
            400
            );
        }
    }
}
