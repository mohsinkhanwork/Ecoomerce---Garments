<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        return view( 'admin.settings.index' );
    }

    public function taxrates() {
        return view( 'admin.settings.taxrates' );
    }
}
