<?php

namespace App\Http\Controllers;

use App\CmsPagesModel;
use Illuminate\Http\Request;

class CmsPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = CmsPagesModel::all();
        return view('admin.settings.cmspages.all',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CmsPagesModel  $cmsPagesModel
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPagesModel $cmsPagesModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CmsPagesModel  $cmsPagesModel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $page = CmsPagesModel::find($id);
       return view("admin.settings.cmspages.edit",compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CmsPagesModel  $cmsPagesModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = CmsPagesModel::find($id);
        $page->fill($request->all());
        $page->save();
        return redirect("dashboard/settings/pages")->with("status","Page Details Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CmsPagesModel  $cmsPagesModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPagesModel $cmsPagesModel)
    {
        //
    }
}
