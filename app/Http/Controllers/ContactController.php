<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMailable;
use Illuminate\Support\Facades\Mail;
use App\Subscriber;
use Illuminate\Support\Facades\Validator;
use App\Rules\GoogleRecaptcha;

class ContactController extends Controller
{

    public function contactUs(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'g-recaptcha-response' => ['required', new GoogleRecaptcha]
        ]);

        if($validator->fails()) {
            return response()->json(['response' => '204']);
        }

        Mail::to('contact@urban-enigma.com')->send(new ContactMailable($data));
        if(count(Mail::failures()) > 0) {
            //return Mail::failures();
            return response()->json(['response' => '406']);
        } else {

            //Save to Subscribers.
            $Subscriber = Subscriber::where('email', $request->subject_email)->first();
            if( ! $Subscriber ) {
                $Subscriber = new Subscriber;
            }
            $Subscriber->name = substr( $request->subject_email, 0, strpos($request->subject_email, '@') );
            $Subscriber->email = $request->subject_email;
            $Subscriber->save();

            return response()->json(['response' => '200']);
        }

    }
}
