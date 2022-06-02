<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;

class CollectionController extends Controller
{
    public function addCollection(Request $request) {

        if($request->isMethod('post')) {
            $data = $request->all();
            $collection = new Collection();
            $collection->name = $data['name'];
            $collection->description = $data['description'];
            $collection->order = $data['order'];
            $collection->status = $data['status'];
            $collection->slider_speed = $data['slider_speed'];

            if($collection->save()) {
                return redirect('/dashboard/add-collection')->with('status','Collection has been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        return view('admin.pages.collections.add_collection');

    }


    public function viewCollection() {
        $collections = Collection::all();
        return view('admin.pages.collections.view_collection')->with(compact('collections'));
    }

    public function editCollection(Request $request, $id) {

        if($request->isMethod('post')) {
            $data = $request->all();
            $collection = Collection::where(['id' => $id])
                                    ->update([
                                        'name' => $data['name'],
                                        'description' => $data['description'],
                                        'order' => $data['order'],
                                        'status' => $data['status'],
                                        'slider_speed' => $data['slider_speed']
                                    ]);
            if($collection) {
                return redirect('/dashboard/manage-collection')->with('status','Collection has been updated successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        $collection_details = Collection::where(['id' => $id])->first();
        return view('admin.pages.collections.edit_collection')->with(compact('collection_details'));
    }

    public function deleteCollection($id = null) {
        $collection = Collection::find($id)->delete();
        if($collection) {
            return redirect('/dashboard/manage-collection')->with('status','Collection has been deleted successfully');
        } else {
            $error = array('error' => 'Invalid delete request!');
            return redirect()->back()->withErrors($error);
        }
    }
    public function deleteMultipleCollection(Request $request) {

      $data = $request->all();
      $ids = explode(",",$data['ids']);

      foreach($ids as $id){

        $collection = Collection::find($id)->delete();

      }

      if($collection) {
          return response()->json(['message' => 'success','code' => '200']);
      } else {
          return response()->json(['message' => 'failed','code' => '400']);
      }


    }
}
