<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'],'password' => $data['password'],'is_admin' => '1'])) {
                return redirect('/dashboard');
            }
            elseif(Auth::attempt(['email' => $data['email'],'password' => $data['password'],'is_admin' => '0'])) {
                return redirect('/');
            }
            else {
                $error = array('email' => 'These credentials do not match our records.','password' => 'These credentials do not match our records.');
                return redirect()->back()->withErrors($error);
            }
        } elseif (Auth::check()) {
            if (Auth::user()->is_admin == 1) {
                return view('admin.pages.main');
            } elseif (Auth::user()->is_admin == 0) {
                return redirect('/');
            }
        } else {
            return view('admin.admin_login');
        }
    }

    public function dashboard() {
        if(Auth::check()) {
            if (Auth::user()->is_admin == 1) {
                return view('admin.pages.main');
            } elseif (Auth::user()->is_admin == 0) {
                return redirect('/');
            }
        } else {
            return view('admin.pages.main');
        }
    }

    public function guest(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'],'password' => $data['password'],'is_admin' => '0'])) {
                return response()->json(['response' => '200']);
            } else {
                return response()->json(['response' => 'These credentials do not match our records.']);
            }
        }
    }
}
