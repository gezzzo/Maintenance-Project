<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MalfunctionStoreRequest;
use App\models\Malfunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class MalfunctionController extends Controller
{


    public function index()
    {
        $malfunctions = Malfunction::all();
        return response()->json(['date' => $malfunctions, 'message' => "The Date is Done."], 200);
    }

    public function show($id)
    {
        $malfunction = Malfunction::find($id);
        if ($malfunction) {
            return response()->json(['date' => $malfunction, 'message' => "The Date is Done."], 200);
        }
        return response()->json(['date' => null, 'message' => "The Date isn't found"], 404);
    }


    // to add Malfunction
//    public function store(MalfunctionStoreRequest $request)
//    {
//
//        try {
//            $imageName = Str::random(32) . "." . $request->img->getClientOriginalExtension();
//
//            Malfunction::create([
//                'name' => $request->name,
//                'description' => $request->description,
//                'img' => $imageName,
//                'location' => $request->location,
//                'customer_id' => $request->customer_id
//
//            ]);
//
//            // Save Image in Storage folder
//            Storage::disk('public')->put($imageName, file_get_contents($request->img));
//
//            // Return Json Response
//            return response()->json([
//                'message' => "Malfunction successfully created."
//            ], 200);
//        } catch (\Exception $e) {
//            // Return Json Response
//            return response()->json([
//                'message' => "Something went really wrong!"
//            ], 500);
//        }
//    }


    // to add Malfunction

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'description' => 'required',
                'img' => 'required',
                'location' => 'required',
                'customer_id' => 'required'
            ]);
            // Add custom error messages
            $validator->setAttributeNames([
                'name' => 'Name',
                'description' => 'Description',
                'img' => 'Image',
                'location' => 'Location',
                'customer_id' => 'Customer ID',
            ]);

            $validator->setCustomMessages([
                'required' => 'The :attribute field is required.',
                'max' => 'The :attribute field should not exceed :max characters.',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()
                ], 400);
            }

            $imageName = Str::random(32) . "." . $request->img->getClientOriginalExtension();
            Malfunction::create([
                'name' => $request->name,
                'description' => $request->description,
                'img' => $imageName,
                'location' => $request->location,
                'customer_id' => $request->customer_id

            ]);
            // Save Image in Storage folder
            Storage::disk('upload')->put($imageName, file_get_contents($request->img));
            return response()->json([
                'message' => "Date successfully created."
            ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'message' => "Something went really wrong!"
                ], 500);
            }
    }




}
