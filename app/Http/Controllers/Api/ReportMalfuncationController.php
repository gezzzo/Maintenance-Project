<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportMalfuncation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ReportMalfuncationController extends Controller
{


    public function index()
    {
        $reports = ReportMalfuncation::all();
        return response()->json(['date' => $reports, 'message' => "The Date is Done."], 200);
    }

    public function show($id)
    {
        $report = ReportMalfuncation::find($id);
        if ($report) {
            return response()->json(['date' => $report, 'message' => "The Date is Done."], 200);
        }
        return response()->json(['date' => null, 'message' => "The Date isn't found"], 404);
    }

    // to add report
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'malfunction_id'=>'required',
                'status' => 'required',
                'description' => 'required',
                'product' => 'required',
                'price' => 'required',
            ]);
            $validator->setAttributeNames([
                'status' => 'Status',
                'description' => 'Description',
                'product' => 'Product',
                'price' => 'Price',
            ]);
            $validator->setCustomMessages([
                'required' => 'The :attribute field is required.',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()
                ], 400);
            }
            ReportMalfuncation::create($request->all());
//            ReportMalfuncation::create([
//                'description' => $request->description,
//                'mechanic_id' => $request->mechanic_id,
//                'technical_id' => $request->technical_id,
//                'malfunction_id' => $request->malfunction_id,
//                'status' => $request->status,
//                'product' => $request->product,
//                'price' => $request->price
//            ]);
            return response()->json([
                'message' => "Date successfully created."
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function update(Request $request,$id)
    {
        $report = ReportMalfuncation::find($id);
        if($report){
            try {
                $validator = Validator::make($request->all(), [
                    'malfunction_id'=>'required',
                    'status' => 'required',
                    'description' => 'required',
                    'product' => 'required',
                    'price' => 'required',
                ]);
                $validator->setAttributeNames([
                    'status' => 'Status',
                    'description' => 'Description',
                    'product' => 'Product',
                    'price' => 'Price',
                ]);
                $validator->setCustomMessages([
                    'required' => 'The :attribute field is required.',
                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'message' => $validator->errors()
                    ], 400);
                }
                $report->update($request->all());
                return response()->json([
                    'message' => "Date successfully updated."
                ], 200);

            } catch (\Exception $e) {
                return response()->json([
                    'message' => "Something went really wrong! "
                ], 500);
            }
        }
        else{
            return response()->json([
                'message' => "The Report is not found."
            ], 404);
        }

    }

}
