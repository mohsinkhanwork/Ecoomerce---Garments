<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebsiteSetting;
use Carbon\Carbon;

class GeneralSettingsController extends Controller
{
    public function __construct(){}

    public function index( Request $request ) {
      $data = [];
      $data['enable_free_shipping'] = WebsiteSetting::where('key','enable_free_shipping')->get()->first();
      $data['free_shipping_from'] = WebsiteSetting::where('key','free_shipping_from')->get()->first();
      $data['free_shipping_to'] = WebsiteSetting::where('key','free_shipping_to')->get()->first();
      $data['free_shipping_cart_amount'] = WebsiteSetting::where('key','free_shipping_cart_amount')->get()->first();

      $data['shipping_from_name'] = WebsiteSetting::where('key','shipping_from_name')->get()->first();
      $data['shipping_from_company'] = WebsiteSetting::where('key','shipping_from_company')->get()->first();
      $data['shipping_from_street1'] = WebsiteSetting::where('key','shipping_from_street1')->get()->first();
      $data['shipping_from_city'] = WebsiteSetting::where('key','shipping_from_city')->get()->first();
      $data['shipping_from_state'] = WebsiteSetting::where('key','shipping_from_state')->get()->first();
      $data['shipping_from_zip'] = WebsiteSetting::where('key','shipping_from_zip')->get()->first();
      $data['shipping_from_country'] = WebsiteSetting::where('key','shipping_from_country')->get()->first();
      $data['shipping_from_phone'] = WebsiteSetting::where('key','shipping_from_phone')->get()->first();
      $data['shipping_from_email'] = WebsiteSetting::where('key','shipping_from_email')->get()->first();
      $data['shipping_from_email'] = WebsiteSetting::where('key','shipping_from_email')->get()->first();


        if( $request->post() ) {

          $enable_free_shipping = WebsiteSetting::where('key','enable_free_shipping')->get()->first();
          $free_shipping_from = WebsiteSetting::where('key','free_shipping_from')->get()->first();
          $free_shipping_to = WebsiteSetting::where('key','free_shipping_to')->get()->first();
          $free_shipping_cart_amount = WebsiteSetting::where('key','free_shipping_cart_amount')->get()->first();

          $enable_free_shipping->value = $request->enable_free_shipping;
          $enable_free_shipping->save();

          $free_shipping_from->value = Carbon::parse($request->free_shipping_from)->format('Y-m-d');
          $free_shipping_from->save();

          $free_shipping_to->value = Carbon::parse($request->free_shipping_to)->format('Y-m-d');
          $free_shipping_to->save();

          $free_shipping_cart_amount->value = $request->free_shipping_cart_amount;
          $free_shipping_cart_amount->save();

          $name = WebsiteSetting::where('key','shipping_from_name')->get()->first();
          $company = WebsiteSetting::where('key','shipping_from_company')->get()->first();
          $street1 = WebsiteSetting::where('key','shipping_from_street1')->get()->first();
          $city = WebsiteSetting::where('key','shipping_from_city')->get()->first();
          $state = WebsiteSetting::where('key','shipping_from_state')->get()->first();
          $zip = WebsiteSetting::where('key','shipping_from_zip')->get()->first();
          $country = WebsiteSetting::where('key','shipping_from_country')->get()->first();
          $phone = WebsiteSetting::where('key','shipping_from_phone')->get()->first();
          $email = WebsiteSetting::where('key','shipping_from_email')->get()->first();

          $name->value = $request->shipping_from_name;
          $name->save();

          $company->value = $request->shipping_from_company;
          $company->save();

          $street1->value = $request->shipping_from_street1;
          $street1->save();

          $city->value = $request->shipping_from_city;
          $city->save();

          $state->value = $request->shipping_from_state;
          $state->save();

          $zip->value = $request->shipping_from_zip;
          $zip->save();

          $country->value = $request->shipping_from_country;
          $country->save();

          $phone->value = $request->shipping_from_phone;
          $phone->save();

          $email->value = $request->shipping_from_email;
          $email->save();




            $debug = $request->env_debug_mode == 1 ? 'true' : 'false';
            $mainatainance = $request->env_maintenance_mode == 1 ? 'true' : 'false';
            $shippo = $request->env_shippo_mode;
            if( ! $this->__setEnv([
                    'APP_DEBUG' => $debug,
                    'DEBUGBAR_ENABLED' => $debug,
                    'COMING_SOON' => $mainatainance,
                    'SHIPPO_MODE' => $shippo
                ])
            ) {
                return redirect()->back()->withErrors(['Something went wrong, please try again later.']);
            }
            return redirect()->back()->with('status', 'Settings saved.');
        }
        return view('admin.settings.general.index',compact('data'));
    }

    private function __setEnv($data) {
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);

            return true;
        } else {
            return false;
        }
    }

    public function phone(){
        $phone = "";
        $setting = WebsiteSetting::where(['key'=>'contact_phone','name'=>'contact_phone'])->first();
        if(!empty($setting)){
            $phone = $setting['value'];
        }
        return view('admin.settings.general.phone',['phone'=>$phone]);
    }

    public function savePhone(Request $req){
        $data = $req->all();
        if(!empty($data)){
            $phone = $data['phone'];
            $setting = WebsiteSetting::where(['key'=>'contact_phone','name'=>'contact_phone'])->first();
            if(empty($setting)){
                $setting = new WebsiteSetting();
                $setting->key = 'contact_phone';
                $setting->name = 'contact_phone';
            }
            $setting->value = $phone;
            $setting->save();
            
        }
        return redirect()->back();
    }
}
