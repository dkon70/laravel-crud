<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Spot;
use Illuminate\Support\Facades\Validator;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Spot::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|unique:spots',
            'latitude' => 'bail|required|numeric',
            'longitude' => 'bail|required|numeric'
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        if (!is_float($request->latitude)) {
            return response()->json(['errors' => ['latitude' => ['latitude must be float']]], 422);
        }
        if (!is_float($request->longitude)) {
            return response()->json(['errors' => ['longitude' => ['longitude must be float']]], 422);
        }

        $validated = Spot::create([
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        return response()->json([$validated], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
