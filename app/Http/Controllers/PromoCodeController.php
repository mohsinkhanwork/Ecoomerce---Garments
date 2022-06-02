<?php

namespace App\Http\Controllers;

use App\PromoCode;
use Illuminate\Http\Request;
use Carbon\Carbon;
class PromoCodeController extends Controller
{
    public function addPromoCode(Request $request)
    {
      if($request->isMethod('post')) {
          $data = $request->all();
          $promoCode = new PromoCode();
          $promoCode->name = $data['name'];
          $promoCode->promo_code = $data['promo_code'];
          $promoCode->type = $data['type'];
          $promoCode->discount_type = $data['discount_type'];
          $promoCode->discount_amount = $data['discount_amount'];
          $promoCode->valid_from = Carbon::parse($data['valid_from'])->format('Y-m-d');
          $promoCode->valid_to = Carbon::parse($data['valid_to'])->format('Y-m-d');
          $promoCode->status = $data['status'];
          $promoCode->is_user_specific = 0;

          if($promoCode->save()) {
              return redirect()->route('manage.promo.admin')->with('status','PromoCode has been added successfully');
          } else {
              $error = array('error' => 'Something went wrong with data!');
              return redirect()->back()->withErrors($error);
          }
      }

      return view('admin.pages.promo_codes.add_promo_code');
    }


    public function viewPromoCode() {
        $promoCodes = PromoCode::all();
        return view('admin.pages.promo_codes.view_promo_codes')->with(compact('promoCodes'));
    }

    public function editPromoCode(Request $request, $id) {

        if($request->isMethod('post')) {
            $data = $request->all();


            $promoCode = PromoCode::find($id);
            $promoCode->name = $data['name'];
            $promoCode->discount_type = $data['discount_type'];
            $promoCode->type = $data['type'];
            $promoCode->discount_amount = $data['discount_amount'];
            $promoCode->valid_from = Carbon::parse($data['valid_from'])->format('Y-m-d');
            $promoCode->valid_to = Carbon::parse($data['valid_to'])->format('Y-m-d');
            $promoCode->status = $data['status'];
            $promoCode->save();

            if($promoCode) {
                return redirect()->route('manage.promo.admin')->with('status','PromoCode has been updated successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        $promoCode = PromoCode::where(['id' => $id])->first();
        return view('admin.pages.promo_codes.edit_promo_codes')->with(compact('promoCode'));
    }

    public function deletePromoCode($id = null) {
        $promoCode = PromoCode::find($id)->delete();
        if($promoCode) {
            return redirect()->route('manage.promo.admin')->with('status','PromoCode has been deleted successfully');
        } else {
            $error = array('error' => 'Invalid delete request!');
            return redirect()->back()->withErrors($error);
        }
    }
    public function deleteMultiplePromoCode(Request $request) {

      $data = $request->all();
      $ids = explode(",",$data['ids']);

      foreach($ids as $id){

        $promoCode = PromoCode::find($id)->delete();

      }

      if($promoCode) {
          return response()->json(['message' => 'success','code' => '200']);
      } else {
          return response()->json(['message' => 'failed','code' => '400']);
      }

    }
}
