<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use function Opis\Closure\serialize;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $category = new Category();
            $category->name = $data['name'];
            $category->parent_id = $data['parent_id'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->filter_cat = $data['filter_cat'];
            $category->display_order = $data['display_order'];
            $category->weight = $data['weight'].'_'.$data['weight_unit'].'_'.$data['weight2'].'_'.$data['weight_unit2'];
            $category->length = $data['length'].'_'.$data['length_unit'];
            $category->width = $data['width'].'_'.$data['width_unit'];
            $category->height = $data['height'].'_'.$data['height_unit'];



            if ($data['filter_cat'] == "yes") {
                $filterImageName = $filterSelectedImageName = '';
                if ($request->hasFile('filter_image')) {
                    $image = $request->file('filter_image');
                    $filterImageName = 'filter_image_'.time().$image->getClientOriginalName();
                    $image->move(public_path('/frontend/assets/images/'), $filterImageName);
                }

                if ($request->hasFile('filter_image_selected')) {
                    $image = $request->file('filter_image_selected');
                    $filterSelectedImageName = 'selected_filter_image_'.time().$image->getClientOriginalName();
                    $image->move(public_path('/frontend/assets/images/'), $filterSelectedImageName);
                }

                if ($filterImageName || $filterSelectedImageName) {
                    $category->filter_image = $filterImageName;
                    $category->filter_image_selected = $filterSelectedImageName;
                }
            }

            if ($data['is_sizechart'] == 1) {
                $desktopImageName = $mobileImageName = '';
                if ($request->hasFile('size_chart_image_desktop')) {
                    $image = $request->file('size_chart_image_desktop');
                    $desktopImageName = rand(111, 9999999).$image->getClientOriginalName();
                    $image->move(public_path('/img/products/drop/'), $desktopImageName);
                }
                if ($request->hasFile('size_chart_image_mobile')) {
                    $image = $request->file('size_chart_image_mobile');
                    $mobileImageName = rand(111, 9999999).$image->getClientOriginalName();
                    $image->move(public_path('/img/products/drop/'), $mobileImageName);
                }
                if ($desktopImageName || $mobileImageName) {
                    $category->size_chart_image = serialize(['desktop' => $desktopImageName, 'mobile' => $mobileImageName]);
                    $category->is_sizechart = 1;
                } else {
                    $category->is_sizechart = 0;
                }
            } else {
                $category->is_sizechart = 0;
            }

            $category->material_care_instruction = $data['material_care_instruction'];

            if ($category->save()) {
                return redirect('/dashboard/add-category')->with('status', 'Category has been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        $levels = Category::where(['parent_id' => 0])->get();

        return view('admin.pages.categories.add_category')->with(compact('levels'));
    }


    public function viewCategory()
    {
        /*$categories = Category::all();*/
        $categories = DB::select(
            DB::raw('SELECT a.*, IFNULL(b.name, "Main") AS parent_name FROM categories a
            LEFT JOIN categories b ON b.id = a.parent_id')
        );

        //echo "<pre>"; print_r($categories); die();

        return view('admin.pages.categories.view_category')->with(compact('categories'));
    }

    public function updateFilterCategory(Request $request)
    {
        if (isset($request->catids) && is_array($request->catids)) {
            DB::table('categories')->update(array('filter_cat' => null));
            foreach ($request->catids as $catids) {
                list($catid, $filter_cat) = explode('__', $catids);
                $response[$catid] = $filter_cat;
                $category = Category::find($catid);
                if ($category) {
                    $category->filter_cat = $filter_cat;
                    $category->save();
                }
            }
            return response()->json($response, 200, []);
        }
    }

    public function editCategory(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            //echo "<pre>"; print_r($data); die();

            $description_sizechart_image = DB::table('categories')
                ->select('size_chart_image')
                ->where('id', $id)
                ->get();

            $oldDesktopImageName = $oldMobileImageName = false;
            $desktopImageName = $mobileImageName = '';
            if (!empty($description_sizechart_image[0]->size_chart_image)) {
                $size_chart_images = @unserialize($description_sizechart_image[0]->size_chart_image);
                if ($size_chart_images !== false && is_array($size_chart_images)) {
                    if (isset($size_chart_images['desktop']) && !empty($size_chart_images['desktop'])) {
                        $desktopImageName = $size_chart_images['desktop'];
                        $oldDesktopImageName = public_path() . '/img/products/drop/' . $desktopImageName;
                    }
                    if (isset($size_chart_images['mobile']) && !empty($size_chart_images['mobile'])) {
                        $mobileImageName = $size_chart_images['mobile'];
                        $oldMobileImageName = public_path() . '/img/products/drop/' . $mobileImageName;
                    }
                }
            }
            $update_values = [
                'name' => $data['name'],
                'parent_id' => $data['parent_id'],
                'description' => $data['description'],
                'filter_cat' => $data['filter_cat'],
                'display_order' => $data['display_order'],
                'url' => $data['url'],
                'material_care_instruction' => $data['material_care_instruction'],
                'weight' => $data['weight'].'_'.$data['weight_unit'].'_'.$data['weight2'].'_'.$data['weight_unit2'],
                'length' => $data['length'].'_'.$data['length_unit'],
                'width' => $data['width'].'_'.$data['width_unit'],
                'height' => $data['height'].'_'.$data['height_unit']
            ];
            $category = Category::where(['id' => $id])->update($update_values);


            if ($data['filter_cat'] == "yes") {
                $filterImageName = $filterSelectedImageName = '';
                $category = Category::where(['id' => $id])->get()->first();
                if ($request->hasFile('filter_image')) {
                    $image = $request->file('filter_image');
                    $filterImageName = 'filter_image_'.time().$image->getClientOriginalName();
                    $image->move(public_path('/frontend/assets/images/'), $filterImageName);
                    $category->filter_image = $filterImageName;
                    $category->save();
                }

                if ($request->hasFile('filter_image_selected')) {
                    $image = $request->file('filter_image_selected');
                    $filterSelectedImageName = 'selected_filter_image_'.time().$image->getClientOriginalName();
                    $image->move(public_path('/frontend/assets/images/'), $filterSelectedImageName);
                    $category->filter_image_selected = $filterSelectedImageName;
                    $category->save();
                }
            }

            if ($data['is_sizechart'] == 1) {
                if ($request->hasFile('size_chart_image_desktop')) {
                    $image = $request->file('size_chart_image_desktop');
                    $desktopImageName = rand(111, 9999999).$image->getClientOriginalName();
                    $image->move(public_path('/img/products/drop/'), $desktopImageName);
                    if ($oldDesktopImageName) {
                        if (file_exists($oldDesktopImageName)) {
                            unlink($oldDesktopImageName);
                        }
                    }
                }
                if ($request->hasFile('size_chart_image_mobile')) {
                    $image = $request->file('size_chart_image_mobile');
                    $mobileImageName = rand(111, 9999999).$image->getClientOriginalName();
                    $image->move(public_path('/img/products/drop/'), $mobileImageName);
                    if ($oldMobileImageName) {
                        if (file_exists($oldMobileImageName)) {
                            unlink($oldMobileImageName);
                        }
                    }
                }
                $category = Category::where(['id' => $id])
                                    ->update([
                                        'size_chart_image' => serialize(['desktop' => $desktopImageName, 'mobile' => $mobileImageName]),
                                        'is_sizechart' => 1
                                    ]);
            } else {
                $category = Category::where(['id' => $id])->update(['size_chart_image' => '', 'is_sizechart' => 0]);

                if ($oldDesktopImageName) {
                    if (file_exists($oldDesktopImageName)) {
                        unlink($oldDesktopImageName);
                    }
                }
                if ($oldMobileImageName) {
                    if (file_exists($oldMobileImageName)) {
                        unlink($oldMobileImageName);
                    }
                }
            }

            if ($category) {
                return redirect('/dashboard/manage-category')->with('status', 'Category has been updated successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        $category_details = Category::where(['id' => $id])->first();
        $levels = Category::where(['parent_id' => 0])->get();
        return view('admin.pages.categories.edit_category')->with(compact('category_details', 'levels'));
    }

    public function deleteCategory($id = null)
    {
        $category = Category::find($id)->delete();
        if ($category) {
            //return view('admin.pages.categories.view_category')->with(compact('category'));
            return redirect('/dashboard/manage-category')->with('status', 'Category has been deleted successfully');
        } else {
            $error = array('error' => 'Invalid delete request!');
            return redirect()->back()->withErrors($error);
        }
    }
    public function deleteMultipleCategory(Request $request)
    {
        $data = $request->all();
        $ids = explode(",", $data['ids']);

        foreach ($ids as $id) {
            $category = Category::find($id)->delete();
        }


        if ($category) {
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }
    }
}
