<?php

namespace App\Http\Controllers;

use App\CategorySlider;
use App\ColorImage;
use App\ColorWiseCategorySlider;
use App\DescriptionSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImageUploadController extends Controller
{
    public function fileReplaceHomepageImage(Request $request)
    {
        $data = $request->all();
        //var_dump($data); die();

        $images = $request->file('image');
        $imageName = rand(111, 9999999).$images->getClientOriginalName();
        $images->move(public_path('/img/products/drop/'), $imageName);
        ColorImage::where(['product_id' => $data['pid'],'id' => $data['hid']])->update([
            'filename' => $imageName,
        ]);

        $path=public_path().'/img/products/drop/'.$data['cim'];
        if (file_exists($path)) {
            unlink($path);
        }

        return response()->json(['success'=>'/img/products/drop/'.$imageName]);
    }

    public function addHomepageImage(Request $request, $pid = null)
    {
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');

            $imageUpload = new ColorImage();
            $imageName = rand(111, 9999999).$image->getClientOriginalName();
            $image->move(public_path('/img/products/drop/'), $imageName);
            $imageUpload->filename = $imageName;
            $imageUpload->product_id = $pid;
            $imageUpload->color_code = $request->color_code;
            $imageUpload->color_name = $request->color_name;
            $status = $imageUpload->save();
        }

        if ($status) {
            return redirect()->back()->with('status', 'Homepage Image has been added successfully');
        } else {
            $error = array('error' => 'Something went wrong with data!');
            return redirect()->back()->withErrors($error);
        }
    }
    public function updateHomepageImage(Request $request, $hid = null)
    {
        $data = $request->all();

        $color_image = ColorImage::where(['id' => $hid])->get()->first();

        if ($request->hasFile('product_image')) {
            $images = $request->file('product_image');
            $imageName = rand(111, 9999999).$images->getClientOriginalName();
            $images->move(public_path('/img/products/drop/'), $imageName);

            $path=public_path().'/img/products/drop/'.$color_image->filename;
            if (file_exists($path)) {
                unlink($path);
            }

            $color_image->filename = $imageName;
        }

        if (isset($request->color_code)) {
            $color_image->color_code = $request->color_code;
        }
        if (isset($request->color_name)) {
            $color_image->color_name = $request->color_name;
        }
        if (isset($request->show_to_option)) {
            $color_image->show_to_option = $request->show_to_option;
        }
        if (isset($request->alt_text)) {
            $color_image->alt_text = $request->alt_text;
        }
        $color_image->save();

        return response()->json('Data has been updated successfully', 200);
        //return redirect()->back()->with('status','Homepage Image has been updated successfully');
    }
    public function deleteHomepageImage($pid = null, $hid = null)
    {
        $filename = ColorImage::select('filename')->where('id', $hid)->first();
        ColorImage::where('id', $hid)->delete();
        $path=public_path().'/img/products/drop/'.$filename->filename;
        if (file_exists($path)) {
            unlink($path);
        }

        $description_data = DB::table('description_slider')
            ->where(['color_id' => $hid])
            ->get();

        $category_data = DB::table('category_slider')
            ->where(['color_id' => $hid])
            ->get();

        $colorwise_category_data = DB::table('colorwise_category_slider')
            ->where(['color_id' => $hid])
            ->get();

        foreach ($description_data as $did) {
            $filename = DescriptionSlider::select('filename')->where('id', $did->id)->first();
            $image = DescriptionSlider::where('id', $did->id)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($category_data as $cid) {
            $filename = CategorySlider::select('filename')->where('id', $cid->id)->first();
            $image = CategorySlider::where('id', $cid->id)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($colorwise_category_data as $ccid) {
            $filename = CategorySlider::select('filename')->where('id', $ccid->id)->first();
            $image = CategorySlider::where('id', $ccid->id)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        return redirect('/dashboard/edit-product/'.$pid)->with('status', 'Homepage Image has been deleted successfully');
    }

    public function fileStoreDescriptionSliderImage(Request $request)
    {
        $data = $request->all();
        //var_dump($data); die();

        $images = $request->file('file');
        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/img/products/drop/'), $imageName);
            $imageUpload = new DescriptionSlider();
            $imageUpload->color_id = $data['color_id'];
            $imageUpload->filename = $imageName;
            $imageUpload->save();
        }

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroyDescriptionSliderImage(Request $request)
    {
        $filename =  $request->get('filename');
        DescriptionSlider::where('filename', $filename)->delete();
        $path=public_path().'/img/products/drop/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function fileStoreCategorySliderImage(Request $request)
    {
        $data = $request->all();
        //var_dump($data); die();

        $images = $request->file('file');
        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/img/products/drop/'), $imageName);
            $imageUpload = new CategorySlider();
            $imageUpload->color_id = $data['color_id'];
            $imageUpload->filename = $imageName;
            $imageUpload->save();
        }

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroyCategorySliderImage(Request $request)
    {
        $filename =  $request->get('filename');
        CategorySlider::where('filename', $filename)->delete();
        $path=public_path().'/img/products/drop/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function deleteDescriptionImage($pid = null, $did = null)
    {
        $filename = DescriptionSlider::select('filename')->where('id', $did)->first();
        DescriptionSlider::where('id', $did)->delete();
        $path=public_path().'/img/products/drop/'.$filename->filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect('/dashboard/add-image/'.$pid)->with('status', 'Description Image has been deleted successfully');
    }

    public function updateDescriptionImage($id, Request $request)
    {
        $file = DescriptionSlider::findOrFail($id);
        $file->alt_text = $request->alt_text;
        $file->save();
        return response()->json('Data has been updated successfully', 200);
    }

    public function deleteMultipleDescriptionImage(Request $request)
    {
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        foreach ($ids as $id) {
            $filename = DescriptionSlider::select('filename')->where('id', $id)->first();
            $image = DescriptionSlider::where('id', $id)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }


        if ($image) {
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }
    }

    public function deleteCategoryImage($pid = null, $cid = null)
    {
        $filename = CategorySlider::select('filename')->where('id', $cid)->first();
        CategorySlider::where('id', $cid)->delete();
        $path=public_path().'/img/products/drop/'.$filename->filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect('/dashboard/add-image/'.$pid)->with('status', 'Category Image has been deleted successfully');
    }

    public function updateCategoryImage($id, Request $request)
    {
        $file = CategorySlider::findOrFail($id);
        $file->alt_text = $request->alt_text;
        $file->save();
        return response()->json('Data has been updated successfully', 200);
    }

    public function deleteMultipleCategoryImage(Request $request)
    {
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        foreach ($ids as $cid) {
            $filename = CategorySlider::select('filename')->where('id', $cid)->first();
            $image = CategorySlider::where('id', $cid)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }


        if ($image) {
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }
    }

    public function fileStoreColorwiseCategorySliderImage(Request $request)
    {
        $data = $request->all();
        //var_dump($data); die();

        $images = $request->file('file');
        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('/img/products/drop/'), $imageName);
            $imageUpload = new ColorWiseCategorySlider();
            $imageUpload->color_id = $data['color_id'];
            $imageUpload->filename = $imageName;
            $imageUpload->save();
        }

        return response()->json(['success'=>$imageName]);
    }

    public function fileDestroyColorwiseCategorySliderImage(Request $request)
    {
        $filename =  $request->get('filename');
        ColorWiseCategorySlider::where('filename', $filename)->delete();
        $path=public_path().'/img/products/drop/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function deleteColorwiseCategoryImage($pid = null, $cid = null)
    {
        $filename = ColorWiseCategorySlider::select('filename')->where('id', $cid)->first();
        ColorWiseCategorySlider::where('id', $cid)->delete();
        $path=public_path().'/img/products/drop/'.$filename->filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect('/dashboard/add-image/'.$pid)->with('status', 'ColorWise Category Image has been deleted successfully');
    }

    public function updateColorwiseCategoryImage($id, Request $request)
    {
        $file = ColorWiseCategorySlider::findOrFail($id);
        $file->alt_text = $request->alt_text;
        $file->save();
        return response()->json('Data has been updated successfully', 200);
    }
    public function deleteMultipleColorwiseCategoryImage(Request $request)
    {
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        foreach ($ids as $cid) {
            $filename = ColorWiseCategorySlider::select('filename')->where('id', $cid)->first();
            $image = ColorWiseCategorySlider::where('id', $cid)->delete();
            $path=public_path().'/img/products/drop/'.$filename->filename;
            if (file_exists($path)) {
                unlink($path);
            }
        }


        if ($image) {
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }
    }
}
