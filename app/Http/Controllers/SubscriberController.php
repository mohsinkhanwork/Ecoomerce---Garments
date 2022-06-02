<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use Validator;

class SubscriberController extends Controller
{
    public function __construct()
    {
    }

    public function saveSubscriber(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'email' => ['required', 'email']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withError('Enter a valid Email.');
        }


        $Subscriber = Subscriber::where('email', $request->email)->first();
        if (! $Subscriber) {
            $Subscriber = new Subscriber();
        } else {
            return redirect()->back()->withError('Email already subscribed.');
        }
        $Subscriber->name = substr($request->email, 0, strpos($request->email, '@'));
        $Subscriber->email = $request->email;
        $Subscriber->save();
        return redirect()->back()->with('message', 'Email Subscribed successfully.');
    }
    public function viewSubscriber()
    {
        $subscribers = Subscriber::all();
        return view('admin.pages.subscribers.view_subscriber', compact('subscribers'));
    }

    public function deleteSubscriber($subscriber_id)
    {
        $subscriber = Subscriber::find($subscriber_id);
        if ($subscriber) {
            if ($subscriber->delete()) {
                return redirect()->back()->with('status', 'Subscriber deleted successfully.');
            }
        }
        return redirect()->back()->withErrors(['No subscriber found to delete.']);
    }
    public function deleteMultipleSubscriber(Request $request)
    {
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        foreach ($ids as $id) {
            $subscriber = Subscriber::find($id)->delete();
        }
        if ($subscriber) {
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }
    }
}
