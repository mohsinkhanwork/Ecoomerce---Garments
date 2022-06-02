<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function viewCustomer() {
        $customers = Customer::all();

        return view('admin.pages.customers.view_customer')->with(compact('customers'));
    }

    public function detailCustomer($cid) {
        $customer = Customer::where(['id' => $cid])->first();
        return response()->json($customer);
    }

    public function deleteCustomer($cid) {
        $customer = Customer::find($cid)->delete();
        if($customer) {
            return redirect('/dashboard/manage-customer')->with('status','Customer has been deleted successfully');
        } else {
            $error = array('error' => 'Invalid delete request!');
            return redirect()->back()->withErrors($error);
        }
    }
    public function deleteMultiCustomer(Request $request) {

      $data = $request->all();
      $ids = explode(",",$data['ids']);

      foreach($ids as $id){
        $customer = Customer::find($id)->delete();
      }


        if($customer) {
          return response()->json(['message' => 'success','code' => '200']);
        } else {
          return response()->json(['message' => 'failed','code' => '400']);
        }


    }
}
