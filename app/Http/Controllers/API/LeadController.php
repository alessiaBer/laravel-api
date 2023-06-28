<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\NewClient;
use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request) {
        
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required|email',
            'mailContent' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        };

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to('alexdeyn@gmail.com')->send(new NewClient($new_lead));

        return response()->json([
            'success' => true
        ]);

    }
}
