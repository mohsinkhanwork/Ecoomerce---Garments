<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\TaxRate;

use function GuzzleHttp\json_decode;

class TaxRateController extends Controller
{
    public function index() {
/*         $state_rates = [
            'Alabama'               => 9.14,
            'Alaska'                => 1.43,
            'Arizona'               => 8.47,
            'Arkansas'              => 9.43,
            'California'            => 8.56,
            'Colorado'              => 7.63,
            'Connecticut'           => 7.35,
            'Delaware'              => 0,
            'District of Columbia'  => 6,
            'Florida'               => 7.05,
            'Georgia'               => 7.29,
            'Hawaii'                => 4.41,
            'Idaho'                 => 6.03,
            'Illinois'              => 8.74,
            'Indiana'               => 7,
            'Iowa'                  => 6.82,
            'Kansas'                => 8.67,
            'Kentucky'              => 6,
            'Louisiana'             => 9.43,
            'Maine'                 => 5.5,
            'Maryland'              => 6,
            'Massachusetts'         => 6.25,
            'Michigan'              => 6,
            'Minnesota'             => 7.43,
            'Mississippi'           => 7.07,
            'Missouri'              => 8.13,
            'Montana'               => 0,
            'Nebraska'              => 6.85,
            'Nevada'                => 8.14,
            'New Hampshire'         => 0,
            'New Jersey'            => 6.6,
            'New Mexico'            => 7.82,
            'New York'              => 8.49,
            'North Carolina'         => 6.97,
            'North Dakota'           => 6.85,
            'Ohio'                  => 7.17,
            'Oklahoma'              => 8.92,
            'Oregon'                => 0,
            'Pennsylvania'          => 6.34,
            'Rhode Island'           => 7,
            'South Carolina'         => 7.43,
            'South Dakota'           => 6.4,
            'Tennessee'             => 9.47,
            'Texas'                 => 8.19,
            'Utah'                  => 6.94,
            'Vermont'               => 6.18,
            'Virginia'              => 5.65,
            'Washington'            => 9.17,
            'West Virginia'          => 6.39,
            'Wisconsin'             => 5.44,
            'Wyoming'               => 5.36,
        ];
foreach($state_rates as $state => $rate) {
    $statedb = \App\State::where('name', $state)->first();
    if( $statedb ) {
        $taxrate = TaxRate::create();

        $taxrate->country_id = $statedb->country_id;
        $taxrate->state_id = $statedb->id;
        $taxrate->city_id = 0;
        $taxrate->zipcode = '';
        $taxrate->rate = $rate;
        $taxrate->status = 1;

        $taxrate->save();
    }
    else {
        $missed[$state] = $rate;
    }
}
dd($missed);
exit; */
        $taxrates = TaxRate::get();
        $countries = \App\Country::orderby('name', 'ASC')->get();
        return view( 'admin.settings.taxrates', compact( 'taxrates', 'countries' ) );
    }

    public function create() {
        $countries = \App\Country::orderby('name', 'ASC')->get();
        return view( 'admin.settings.taxrates_create', compact( 'countries' ) );
    }

    public function store( Request $request ) {
        $taxRate = TaxRate::create();
        $taxRate->country_id = $request->country_id;
        $taxRate->state_id = $request->state_id;
        $taxRate->rate = $request->rate;
        $taxRate->status = $request->status;
        if( $taxRate->save() ){
            return redirect( url('/dashboard/settings/taxrates') )->with('status', 'Tax rate created successfully.');
        }
        return redirect()->back()->with('status', 'Something went wrong, please try again later');
    }

    public function edit( $id ) {
        $taxrate = TaxRate::findOrFail( $id );
        if( $taxrate ) {
            $countries = \App\Country::orderby('name', 'ASC')->get();
            $states = \App\State::where( 'country_id', $taxrate->country_id )->orderBy('name', 'ASC')->get();
            return view( 'admin.settings.taxrates_edit', compact( 'taxrate', 'countries', 'states' ) );
        }
        return redirect()->back()->with('status', 'No Tax Rate found.');
    }

    public function update( Request $request, $id ) {
        $taxRate = TaxRate::findOrFail( $id );
        if( $taxRate ) {
            $taxRate->country_id = $request->country_id;
            $taxRate->state_id = $request->state_id;
            $taxRate->rate = $request->rate;
            $taxRate->status = $request->status;
            if( $request->ajax() ) {
                if( $taxRate->save() ){
                    return response()->json(['country' => $taxRate->country->name, 'state' => $taxRate->state->name, 'rate' => $taxRate->rate.'%', 'status' => ($taxRate->status == 1 ? "Active" : "Inactive")], 200);
                }
                return response()->json(['status', 'Something went wrong, please try again later'], 400);
            }
            else {
                if( $taxRate->save() ){
                    return redirect( url('/dashboard/settings/taxrates') )->with('status', 'Tax rate updated successfully.');
                }
                return redirect()->back()->with('status', 'Something went wrong, please try again later');
            }
        }
        if( $request->ajax() ) {
            return response()->json(['status', 'No Tax Rate found.'], 400);
        }
        else {
            return redirect()->back()->with('status', 'No Tax Rate found.');
        }
    }

    public function delete( $id ) {
        $taxRate = TaxRate::findOrFail( $id );
        if( $taxRate ) {
            if( $taxRate->delete() ) {
                return redirect( url('/dashboard/settings/taxrates') )->with('status', 'Tax rate deleted successfully.');
            }
            return redirect()->back()->with('status', 'Something went wrong, please try again later');
        }
        return redirect()->back()->with('status', 'No Tax Rate found.');
    }

    public function deleteMultipleTaxRates( Request $request ) {

      $data = $request->all();
      $ids = explode(",",$data['ids']);

      foreach($ids as $id){

        $taxRate = TaxRate::findOrFail( $id )->delete();

      }

      if($taxRate) {
          return response()->json(['message' => 'success','code' => '200']);
      } else {
          return response()->json(['message' => 'failed','code' => '400']);
      }


        }

    public function getStates( Request $request ) {
        if( $request->ajax() ) {
            $states = \App\State::where( 'country_id', $request->country_id )->orderBy('name', 'ASC')->get()->toArray();
            if( $states ) {
                return response()->json( $states, 200 );
            }
            return response()->json(false, 400);
        }
        exit;
    }
}
