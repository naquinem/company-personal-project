<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    public function index()
    {
        $data = Clinic::all();
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
        $data = Clinic::find($id);
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
    public function store(Request $request){
        $validatedData = $request->validate([
            'clinic_name' => 'required|string',
            'doctors_name' => 'required|string',
            'serial_number' => 'required|string',
            'clinic_code' => 'required|string',
            'installation_date' => 'required|string',
            'product' => 'required|string',
            'address' => 'required|string',
        ]);
        if($validatedData) {
            $data = Clinic::create([
                'clinic_name' => $validatedData['clinic_name'],
                'doctors_name' => $validatedData['doctors_name'],
                'serial_number' => $validatedData['serial_number'],
                'clinic_code' => $validatedData['clinic_code'],
                'installation_date' => $validatedData['installation_date'],
                'product' => $validatedData['product'],
                'address' => $validatedData['address'],
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
