<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Paymentmal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class PaymentmalController extends Controller
{

    public function show($id)
    {
        $payment = Paymentmal::Where('malfunction_id','like',$id)->first();
        if ($payment) {
            return response()->json(['date' => $payment, 'message' => "The Date is Done."], 200);
        }
        return response()->json(['date' => null, 'message' => "The Date isn't found"], 404);
    }

    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'img' => 'required',
                'malfunction_id' => 'required'
            ]);
            // Add custom error messages
            $validator->setAttributeNames([
                'img' => 'Image',
                'malfunction_id' => 'Malfunction ID',
            ]);

            $validator->setCustomMessages([
                'required' => 'The :attribute field is required.',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()
                ], 400);
            }

            $imageName = Str::random(32) . "." . $request->img->getClientOriginalExtension();
            Paymentmal::create([
                'img' => $imageName,
                'malfunction_id' => $request->malfunction_id

            ]);
            // Save Image in Storage folder
//            Storage::disk('public')->put($imageName, file_get_contents($request->img));
            Storage::disk('upload')->put($imageName, file_get_contents($request->img));
            return response()->json([
                'message' => "Date successfully created."
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went really wrong! $e"
            ], 500);
        }
    }


}
