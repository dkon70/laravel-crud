<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return UserResource::collection(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'bail|required|unique:users|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'login' => $request->login,
            'password' => Hash::make($request->password, ['rounds' => env('BCRYPT_ROUNDS')]),
        ]);

        return response()->json([new UserResource($user)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::select('favorites')->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'spot' => 'bail|required|exists:spots,name',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => ['User not found']], 404);
        }

        $favoritesArray = $user->favorites;
        if ($favoritesArray[0] === null) {
            $favoritesArray = [];
        }

        $spot = $request->input('spot');
        if (!in_array($spot, $favoritesArray) && count($favoritesArray) < 3) {
            $favoritesArray[] = $spot;
        } else {
            if (in_array($spot, $favoritesArray)) {
                return response()->json(['error' => ['Spot is already in favorites']], 422);
            }
            if (count($favoritesArray) === 3) {
                return response()->json(['error' => ['You can add only 3 spots in favorites']], 422);
            }
        }

        $user->favorites = $favoritesArray;
        $user->save();

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
