<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewContact;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request){
        $success = true;
        $data = $request->all();

        $validator = Validator::make($data,
            [
                'name' => 'required|string|max:100',
                'email' => 'required|email|max:100',
                'message' => 'required|string|min:10'
            ],
            [
                'name.required' => 'Il Nome è obbligatorio',
                'name.string' => 'Il Nome deve essere una stringa',
                'name.max' => 'Il Nome può avere massimo :max caratteri',
                'email.required' => 'La mail è obbligatoria',
                'email.email' => 'La mail deve essere una mail valida',
                'email.max' => 'La mail può avere massimo :max caratteri',
                'message.required' => 'Il Messaggio è obbligatorio',
                'message.string' => 'Il Messaggio deve essere una stringa',
                'message.min' => 'Il Messaggio deve avere almeno :min caratteri'
            ]
        );

        if($validator->fails()){
            $success = false;
            $errors = $validator->errors();
            return response()->json(compact('success', 'errors'));
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to($new_lead->email)->send(new NewContact($new_lead));

        return response()->json(compact('success'));
    }
}
