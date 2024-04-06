<?php

namespace App\Http\Controllers;

use App\Models\Spare;
use Illuminate\Http\Request;
use App\Http\Requests\SpareRequest;

class SpareController extends Controller
{
    public function index()
    {
        $data = Spare::all();
        if(!$data){
            return response()->json([
                'message' => 'No data found in the database'
            ], 404);
        } else {
            return response()->json([
                'data' => $data
            ], 200);
        }
    }
    public function show($id)
    {
        $data = Spare::find($id);
        if(!$data){
            return response()->json([
                'message' => 'No data found in the database'
            ], 404);
        } else {
            return response()->json([
                'data' => $data
            ], 200);
        }
    }
    public function store(SpareRequest $request){
        $validatedData = $request->validated();
        if($validatedData) {
            $data = Spare::create([
                'item_code' => $validatedData['item_code'],
                'description' => $validatedData['description'],
                'quantity' => $validatedData['quantity'],
                'price' => $validatedData['price']
            ]);
            return response()->json([
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'message' => $request->errors()->first()
            ], 422);
        }

    }
}
