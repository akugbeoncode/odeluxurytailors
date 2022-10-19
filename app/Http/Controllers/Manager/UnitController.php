<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Unit;
use App\Http\Resources\Unit as UnitResource;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Storage;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
     
        return UnitResource::collection($units);
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
            'code' => 'required|string|max:5',
        ]);

        $unit = Unit::where('name', $request->name)->orWhere('code', $request->code)->first();

        if ($unit) {
            $data = [
            'message' => 'Unit record with ' . $request->name . ' name already exist!',
            'status' => 403
            ];
            return response()->json($data, 403);
        }

        $new_unit = new Unit();

        $new_unit->name = htmlspecialchars($request->name);
        $new_unit->code = htmlspecialchars($request->name);
        $new_unit->base_unit = $request->base_unit;
        $new_unit->operator = $request->operator;
        $new_unit->operational_value = $request->operational_value;
        $new_unit->description = htmlspecialchars($request->description);
        $new_unit->is_active = $request->is_active ? 1 : 0;

        if ($new_unit->save()) {
            $data = [
            'message' => 'Unit record was added successfully.',
            'status' => 200
            ];
            return response()->json($data, 200);
        } else {
            $data = [
            'message' => 'Attempt to add unit record failed!',
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
            Unit::findOrFail($id), 
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
        $targetUnit = Unit::findOrFail($id);
        
        $validator = $this->validate($request, [
            'name' => 'required|string|between:3,100',
            'code' => 'required|string|max:5',
        ]);

        $targetUnit->name = htmlspecialchars($request->name);
        $targetUnit->code = htmlspecialchars($request->code);
        $targetUnit->base_unit = $request->base_unit;
        $targetUnit->operator = $request->operator;
        $targetUnit->operational_value = $request->operational_value;
        $targetUnit->description = htmlspecialchars($request->description);
        $targetUnit->is_active = $request->is_active ? 1 : 0;

        if ($targetUnit->save()) {
          $data = [
            'message' => 'Product unit record was update successfully.',
            'status' => 200
          ];
          return response()->json($data, 200);
        } else {
          $data = [
            'message' => 'Attempt to update product unit record failed!',
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
        $targetUnit = Unit::findOrFail($id);

        if ($targetUnit->delete()) {
            return response()->json(['message' => 'Product unit was deleted successfully.'], 
            200
            );
        } else {
            return response()->json(['message' => 'Product unit delete attempt failed.'], 
            400
            );
        }
    }
}
