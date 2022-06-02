<?php

namespace App\Http\Controllers;

use App\CategorySlider;
use App\DescriptionSlider;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Category;
use App\Collection;
use App\Cart;
use App\Product;
use App\ColorImage;
use App\ProductAttributes;
use App\ProductsAttributesColor;
use App\AttributeColors;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Image;
use Illuminate\Support\Facades\DB;
use Cart as SCart;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    |                               Add Product Method
    |--------------------------------------------------------------------------
    */
    public function addProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $alias = strtolower(str_replace(" ", "-", $data['product_name']));

            $product = new Product();
            $product->category_id = $data['category_id'];
            $product->collection_id = $data['collection_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->description = $data['product_description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['product_meta_description'];
            $product->meta_keywords = $data['product_meta_keywords'];
            $product->overlay_button_text = $data['overlay_button_text'];
            $product->overlay_button_product_text = $data['overlay_button_product_text'];
            $product->alias = Product::where('alias', $alias)->first() ? $alias.'-'.rand(1000, 9999) : $alias;
            $response = $product->save();
            $product_id = $product->id;

            if ($request->hasFile('product_image')) {
                $images = $request->file('product_image');
                foreach ($images as $key => $image) {
                    $imageUpload = new ColorImage();
                    $imageName = rand(111, 9999999).$image->getClientOriginalName();
                    $image->move(public_path('/img/products/drop/'), $imageName);
                    $imageUpload->filename = $imageName;
                    $imageUpload->product_id = $product_id;
                    $imageUpload->color_code = $data['color_code'][$key];
                    $imageUpload->color_name = $data['color_name'][$key];
                    $imageUpload->show_to_option = $data['show_to_option'][$key];
                    $imageUpload->save();
                }
            }

            //return redirect('/dashboard/add-product')->with('status','Product has been added successfully');

            // Upload Image
            /*if($request->hasFile('product_image')) {
                $image_tmp = Input::file('product_image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'img/products/large/'.$filename;
                    $medium_image_path = 'img/products/medium/'.$filename;
                    $small_image_path = 'img/products/small/'.$filename;

                    // Resize Image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    // Store image name in product table
                    $product->image = $filename;
                }
            }*/

            if ($response) {
                //$colors_data = Product::with('color_image')->where(['id' => $product_id])->get();
                //echo "<pre>"; print_r($colors_data); die();
                //return view('admin.pages.products.add_images')->with(compact('colors_data'));
                return redirect('/dashboard/add-image/' . $product_id)->with('status', 'Product has been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            $categories_dropdown .= "<option value='" . $cat->id . "'>" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value='" . $sub_cat->id . "'>&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }

        $collections = Collection::all();
        $collections_dropdown = "<option selected disabled>Select</option>";
        foreach ($collections as $collection) {
            $collections_dropdown .= "<option value='" . $collection->id . "'>" . $collection->name . "</option>";
        }

        return view('admin.pages.products.add_product')->with(compact('categories_dropdown', 'collections_dropdown'));
    }
    /************************** ./Add Product Method **************************/


    /*
    |--------------------------------------------------------------------------
    |                               Add Image Method
    |--------------------------------------------------------------------------
    */
    public function addImage(Request $request, $id = null)
    {
        $products_data = Product::where(['id' => $id])->get();
        $colors_data = ColorImage::where(['product_id' => $id])->get();
        //echo "<pre>"; print_r($products_data); die();

        $description_data = DB::table('colors_images')
            ->join('description_slider', 'colors_images.id', '=', 'description_slider.color_id')
            ->where(['colors_images.product_id' => $id])
            ->get();

        $category_data = DB::table('colors_images')
            ->join('category_slider', 'colors_images.id', '=', 'category_slider.color_id')
            ->where(['colors_images.product_id' => $id])
            ->get();

        $colorwise_category_data = DB::table('colors_images')
            ->join('colorwise_category_slider', 'colors_images.id', '=', 'colorwise_category_slider.color_id')
            ->where(['colors_images.product_id' => $id])
            ->get();

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();

            $response;

            foreach ($data['color_code'] as $key => $val) {
                if (!empty($val)) {
                    $attribute_colors = new AttributeColors();
                    $attribute_colors->attribute_id = $data['attribute_id'];
                    $attribute_colors->color_name = $data['color_name'][$key];
                    $attribute_colors->color_code = $data['color_code'][$key];
                    $response = $attribute_colors->save();
                }
            }

            if ($response) {
                return redirect('/dashboard/add-image/' . $id)->with('status', 'Colors Images have been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        //return view('admin.pages.products.add_image')->with(compact('colors_data', 'description_data', 'category_data'));
        return view('admin.pages.products.add_image')->with(compact('products_data', 'colors_data', 'description_data', 'category_data', 'colorwise_category_data'));
    }
    /************************** ./Add Image Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               View Product Method
    |--------------------------------------------------------------------------
    */
    public function viewProduct()
    {
        $images = ColorImage::get();

        /*$products = Product::all();
        foreach ($products as $key => $val) {
            $category_name = Category::where(['id' => $val->category_id])->first();
            $products[$key]->category_name = $category_name->name;

            $collection_name = Collection::where(['id' => $val->collection_id])->first();
            $products[$key]->collection_name = $collection_name->name;
        }*/

        $products = DB::table('products AS p')
            ->leftJoin('categories AS cat', 'cat.id', '=', 'p.category_id')
            ->leftJoin('collections AS col', 'col.id', '=', 'p.collection_id')
            ->select(
                'p.id',
                'p.product_code',
                'p.product_name',
                DB::raw('IFNULL(cat.name,"Empty") AS category_name'),
                DB::raw('IFNULL(col.name,"Empty") AS collection_name'),
                'p.description'
            )->get();

        //echo "<pre>"; print_r($products); die();
        return view('admin.pages.products.view_product')->with(compact('products', 'images'));
    }
    /************************** ./View Product Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Edit Product Method
    |--------------------------------------------------------------------------
    */
    public function editProduct(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();

            // Upload Image
            /*if($request->hasFile('product_image')) {
                $image_tmp = Input::file('product_image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'img/products/large/'.$filename;
                    $medium_image_path = 'img/products/medium/'.$filename;
                    $small_image_path = 'img/products/small/'.$filename;

                    // Resize Image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                }
            } else {
                $filename = $data['current_image'];
            }*/
            $alias = strtolower(str_replace(' ', '-', $data['alias']));
            $product = Product::where(['id' => $id])->update([
                'category_id'       => isset($data['category_id'])?$data['category_id']:null,
                'collection_id'     => isset($data['collection_id'])?$data['collection_id']:null,
                'product_name'      => isset($data['product_name'])?$data['product_name']:null,
                'product_code'      => isset($data['product_code'])?$data['product_code']:null,
                'description'       => isset($data['product_description'])?$data['product_description']:null,
                'home_title'        => isset($data['home_title'])?$data['home_title']:null,
                'short_description'  => isset($data['short_description'])?$data['short_description']:null,
                'meta_title'        => isset($data['meta_title'])?$data['meta_title']:null,
                'meta_description'  => isset($data['product_meta_description'])?$data['product_meta_description']:null,
                'meta_keywords'     => isset($data['product_meta_keywords'])?$data['product_meta_keywords']:null,
                'overlay_button_text'     => isset($data['overlay_button_text'])?$data['overlay_button_text']:null,
                'overlay_button_product_text'     => isset($data['overlay_button_product_text'])?$data['overlay_button_product_text']:null,
                'alias'             => Product::where([['alias',$alias],['id','<>',$id]])->first() ? $alias."-".rand(1000, 9999) : $alias,
            ]);

            if ($product) {
                return redirect('/dashboard/manage-product')->with('status', 'Product has been updated successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        // Get Product Details
        $product_details = Product::where(['id' => $id])->first();

        // Category Dropdown Start
        $categories = Category::where(['parent_id' => 0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat) {
            if ($cat->id == $product_details->category_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown .= "<option value='" . $cat->id . "' " . $selected . ">" . $cat->name . "</option>";
            $sub_categories = Category::where(['parent_id' => $cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if ($sub_cat->id == $product_details->category_id) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value='" . $sub_cat->id . "' " . $selected . ">&nbsp;--&nbsp;" . $sub_cat->name . "</option>";
            }
        }
        // Category Dropdown End

        // Collection Dropdown Start
        $collections = Collection::all();
        $collections_dropdown = "<option selected disabled>Select</option>";
        foreach ($collections as $collection) {
            if ($collection->id == $product_details->collection_id) {
                $selected = "selected";
            } else {
                $selected = "";
            }
            $collections_dropdown .= "<option value='" . $collection->id . "' " . $selected . ">" . $collection->name . "</option>";
        }
        // Collection Dropdown End

        // Homepage Images
        $homepage_images = ColorImage::where(['product_id' => $id])->get();

        return view('admin.pages.products.edit_product')->with(compact('product_details', 'categories_dropdown', 'collections_dropdown', 'homepage_images'));
    }
    /************************** ./Edit Product Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Delete Product Method
    |--------------------------------------------------------------------------
    */
    public function deleteProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $homepage_images = ColorImage::where(['product_id' => $data['pid']])->get();

            $color_ids_array = array_pluck($homepage_images, 'id');

            $description_slider = DescriptionSlider::whereIn('color_id', $color_ids_array)->get();

            foreach ($description_slider as $key => $val) {
                $img_path = public_path().'/img/products/drop/'.$val->filename;
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }

            $description_slider_delete = DescriptionSlider::whereIn('color_id', $color_ids_array)->delete();

            $category_slider = CategorySlider::whereIn('color_id', $color_ids_array)->get();

            foreach ($category_slider as $key => $val) {
                $img_path = public_path().'/img/products/drop/'.$val->filename;
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }

            $category_slider_delete = CategorySlider::whereIn('color_id', $color_ids_array)->delete();

            foreach ($homepage_images as $key => $val) {
                $img_path = public_path().'/img/products/drop/'.$val->filename;
                if (file_exists($img_path)) {
                    unlink($img_path);
                }
            }

            $homepage_images_delete = ColorImage::where(['product_id' => $data['pid']])->delete();

            $product_attributes = ProductAttributes::where(['product_id' => $data['pid']])->get();

            $attribute_ids_array = array_pluck($product_attributes, 'id');

            $attributes_colors_delete = AttributeColors::whereIn('attribute_id', $attribute_ids_array)->delete();

            $product_attributes_delete = ProductAttributes::where(['product_id' => $data['pid']])->delete();

            $product_delete = Product::where(['id' => $data['pid']])->delete();

            if ($description_slider_delete && $category_slider_delete && $homepage_images_delete && $attributes_colors_delete && $product_attributes_delete && $product_delete) {
                return response()->json(['message' => 'success','code' => '200']);
            } else {
                return response()->json(['message' => 'failed','code' => '400']);
            }
        } else {
            return response()->json(['message' => 'error','code' => '401']);
        }
    }
    /************************** ./Delete Product Method **************************/
    /*
    |--------------------------------------------------------------------------
    |                               Delete multiple Product Method
    |--------------------------------------------------------------------------
    */
    public function deleteMultiProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $ids = explode(",", $data['ids']);

            foreach ($ids as $id) {
                $homepage_images = ColorImage::where(['product_id' => $id])->get();

                $color_ids_array = array_pluck($homepage_images, 'id');

                $description_slider = DescriptionSlider::whereIn('color_id', $color_ids_array)->get();

                foreach ($description_slider as $key => $val) {
                    $img_path = public_path().'/img/products/drop/'.$val->filename;
                    if (file_exists($img_path)) {
                        unlink($img_path);
                    }
                }

                $description_slider_delete = DescriptionSlider::whereIn('color_id', $color_ids_array)->delete();

                $category_slider = CategorySlider::whereIn('color_id', $color_ids_array)->get();

                foreach ($category_slider as $key => $val) {
                    $img_path = public_path().'/img/products/drop/'.$val->filename;
                    if (file_exists($img_path)) {
                        unlink($img_path);
                    }
                }

                $category_slider_delete = CategorySlider::whereIn('color_id', $color_ids_array)->delete();

                foreach ($homepage_images as $key => $val) {
                    $img_path = public_path().'/img/products/drop/'.$val->filename;
                    if (file_exists($img_path)) {
                        unlink($img_path);
                    }
                }

                $homepage_images_delete = ColorImage::where(['product_id' => $id])->delete();

                $product_attributes = ProductAttributes::where(['product_id' => $id])->get();

                $attribute_ids_array = array_pluck($product_attributes, 'id');

                $attributes_colors_delete = AttributeColors::whereIn('attribute_id', $attribute_ids_array)->delete();

                $product_attributes_delete = ProductAttributes::where(['product_id' => $id])->delete();

                $product_delete = Product::where(['id' => $id])->delete();
            }

            if ($description_slider_delete && $category_slider_delete && $homepage_images_delete && $attributes_colors_delete && $product_attributes_delete && $product_delete) {
                return response()->json(['message' => 'success','code' => '200']);
            } else {
                return response()->json(['message' => 'failed','code' => '400']);
            }
        } else {
            return response()->json(['message' => 'error','code' => '401']);
        }
    }
    /************************** ./Delete multiple Product Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Delete Product Image Method
    |--------------------------------------------------------------------------
    */
    public function deleteProductImage($id = null)
    {
        Product::where(['id' => $id])->update(['image' => '']);
        return redirect()->back()->with('status', 'Image has been deleted successfully');
    }
    /************************** ./Delete Product Image Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Add Product Attribute Method
    |--------------------------------------------------------------------------
    */
    public function addAttribute(Request $request, $id = null)
    {
        //$product_details = Product::with('attributes')->where(['id' => $id])->first();
        //echo "<pre>"; print_r($product_details); die();

        $product_details = DB::table('products')
            ->where('id', $id)
            ->first();

        //var_dump($product_details); die();

        $sizes = ['s', 'm', 'l', 'xl', '2xl', '3xl', '4xl'];

        $product_attributes_details = DB::table('products_attributes')
            ->where('product_id', $id)
            ->orderByRaw('FIELD (size, "' . implode('", "', $sizes) . '") ASC')
            ->get();

        // echo "<pre>"; print_r($product_attributes_details); die();


        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo ( in_array(1, $data['size']) ) ? 'y' : 'n';
            // echo "<pre>"; print_r($data); die();

            $response = false;
            if (in_array(1, $data['size'])) {
                ProductAttributes::where('product_id', $data['product_id'])->delete();

                $key = array_search(1, $data['size']);
                $attribute = new ProductAttributes();
                $attribute->product_id = $data['product_id'];
                $attribute->sku = $data['sku'][$key];
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $response = $attribute->save();
            } else {
                ProductAttributes::where('product_id', $data['product_id'])->where('size', 1)->delete();

                foreach ($data['sku'] as $key => $val) {
                    if (!empty($val)) {
                        $attribute = new ProductAttributes();
                        $attribute->product_id = $data['product_id'];
                        $attribute->sku = $val;
                        $attribute->size = $data['size'][$key];
                        $attribute->price = $data['price'][$key];
                        $response = $attribute->save();
                    }
                }
            }


            if ($response) {
                return redirect('/dashboard/add-attribute/' . $id)->with('status', 'Product Attributes have been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        return view('admin.pages.products.add_attribute')->with(compact('product_details', 'product_attributes_details'));
    }
    /************************** ./Add Product Attribute Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Delete Product Attribute Method
    |--------------------------------------------------------------------------
    */
    public function updateAttribute(Request $request, $aid = null)
    {
        $attribute = ProductAttributes::where(['id' => $aid])->get()->first();
        $attribute->sku = $request->sku;
        $attribute->size = $request->size;
        $attribute->price = $request->price;
        $status = $attribute->save();
        if ($status) {
            return redirect()->back()->with('status', 'Product Attribute updated successfully.');
        } else {
            $error = array('error' => 'Something went wrong with data!');
            return redirect()->back()->withErrors($error);
        }
    }

    public function deleteAttribute($pid = null, $aid = null)
    {
        $attribute = ProductAttributes::where(['id' => $aid])->delete();
        $attribute_colors = AttributeColors::where(['attribute_id' => $aid])->delete();

        if ($attribute && $attribute_colors) {
            return redirect('/dashboard/add-attribute/' . $pid)->with('status', 'Product Attribute has been deleted successfully');
        } else {
            $error = array('error' => 'Something went wrong with data!');
            return redirect()->back()->withErrors($error);
        }
    }
    /******************** ./Delete Product Attribute Method ********************/

    /*
    |--------------------------------------------------------------------------
    |                               Add Product Attribute Color Method
    |--------------------------------------------------------------------------
    */
    public function addAttributeColor(Request $request, $id = null)
    {
        $attribute_details = ProductAttributes::where(['id' => $id])->first();
        $product_name = Product::where(['id' => $attribute_details->product_id])->first();

        $product_colors_data = ColorImage::where(['product_id' => $attribute_details->product_id])
            ->whereIn('id', function ($query) {
                $query->select('color_id')
                    ->from('description_slider');
            })->get();

        $attribute_colors_data = AttributeColors::where(['attribute_id' => $id])->get();
        //echo "<pre>"; print_r($product_name); die();
        //echo "<pre>"; print_r($attribute_details); die();
        //echo "<pre>"; print_r($product_colors_data); die();

        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die();

            $response;

            foreach ($data['color_id'] as $key => $val) {
                //echo "<pre>"; print_r($val);
                $attribute_colors = new AttributeColors();
                $attribute_colors->attribute_id = $data['attribute_id'];
                $attribute_colors->color_id = $data['color_id'][$key];
                $attribute_colors->color_code = $data['color_code'][$key];
                $attribute_colors->color_name = $data['color_name'][$key];
                $attribute_colors->color_stock = $data['color_stock'][$key];
                $response = $attribute_colors->save();
            }
            //die();

            //return redirect('/dashboard/add-attribute-color-stock/'.$id)->with('status','Attribute Colors Stock has been added successfully');

            if ($response) {
                return redirect('/dashboard/add-attribute-color-stock/' . $id)->with('status', 'Attribute Colors Stock has been added successfully');
            } else {
                $error = array('error' => 'Something went wrong with data!');
                return redirect()->back()->withErrors($error);
            }
        }

        return view('admin.pages.products.add_attribute_color')->with(compact('attribute_details', 'product_name', 'attribute_colors_data', 'product_colors_data'));
    }
    /************************** ./Add Product Attribute Color Method **************************/

    /*
    |--------------------------------------------------------------------------
    |                               Delete Product Attribute Color Method
    |--------------------------------------------------------------------------
    */
    public function deleteAttributeColor($aid = null, $cid = null)
    {
        $attribute_color = AttributeColors::where(['id' => $cid])->delete();
        if ($attribute_color) {
            return redirect('/dashboard/add-attribute-color/' . $aid)->with('status', 'Attribute Color has been deleted successfully');
        } else {
            $error = array('error' => 'Something went wrong with data!');
            return redirect()->back()->withErrors($error);
        }
    }
    /******************** ./Delete Product Attribute Color Method ********************/

    /*
    |--------------------------------------------------------------------------
    |                               Delete Product Attribute Color Method
    |--------------------------------------------------------------------------
    */
    public function updateAttributeColorStock(Request $request)
    {
        $data = $request->all();

        $attribute_stock = AttributeColors::where(['id' => $data['acid']])->update([
            'color_stock' => $data['stock']
        ]);

        if ($attribute_stock) {
            return response()->json(['message' => 'success', 'code' => '200']);
        } else {
            return response()->json(['message' => 'failed', 'code' => '400']);
        }
    }
    public function updateMaxCartQty(Request $request)
    {
        $data = $request->all();

        $attribute_stock = AttributeColors::where(['id' => $data['acid']])->update([
            'max_cart_qty' => $data['max_cart_qty']
        ]);

        if ($attribute_stock) {
            return response()->json(['message' => 'success', 'code' => '200']);
        } else {
            return response()->json(['message' => 'failed', 'code' => '400']);
        }
    }
    /******************** ./Delete Product Attribute Color Method ********************/

    /*
    |--------------------------------------------------------------------------
    |                               Add To Cart Method
    |--------------------------------------------------------------------------
    */
    public static function getColorStock($id)
    {
        $attribute_color = ProductsAttributesColor::find($id);
        if ($attribute_color) {
            return $attribute_color->available_qty;
        }
        return 0;
    }
    public function addToCart(Request $request)
    {
        //dd($request);
        $data = $request->get('data');

        $session_id = Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            Session::put('session_id', $session_id);
        }

        /**
         * $data
         * 0 => product_id
         * 1 => attribute_color_id
         * 2 => attribute_id
         * 3 => quantity
         * 4 => price
         */

        $product = Product::where('alias', $data[0]['value'])->orWhere('id', $data[0]['value'])->first();
        $color_id = $data[1]['value'];
        $attribute_id = $data[2]['value'];
        $quantity = $data[3]['value'];

        if ($request->called_from == 'category_page') {
            $attribute_color = ProductsAttributesColor::find($color_id);
        } else {
            $attribute_color = ProductsAttributesColor::where('attribute_id', $attribute_id)->where('color_id', $color_id)->get()->first();
        }

        if ($attribute_color) {
            $color_iamge = DB::table('colors_images')->find($attribute_color->color_id);
            $qty = 0;
            $cart_quantity = SCart::get($product->id ."_".$attribute_id."_".$attribute_color->id);

            if ($cart_quantity) {
                $qty = $cart_quantity->quantity;
            }


            if ($qty < $attribute_color->available_qty) {
                $price = DB::table('products_attributes')->select('price', 'size')->where('id', $attribute_id)->get()->first();



                SCart::add(array(
                    'id' => $product->id ."_".$attribute_id."_".$attribute_color->id,
                    'name' => $product->product_name,
                    'quantity' => (int)$data[3]['value'],
                    'price' => $price->price,
                    'attributes' => array(
                        'product_id' => (int)$product->id,
                        'product_name' => $product->product_name,
                        'attribute_id' => (int)$attribute_id,
                        'attribute_name' => $price->size,
                        'attribute_color_id' => (int)$attribute_color->id,
                        'color_id' => (int)$attribute_color->color_id,
                        'attribute_color_name' => $attribute_color->color_name,
                        'attribute_color_image' => $color_iamge->filename,
                        'attribute_color_image_alt_text' => $color_iamge->alt_text,
                    )
                ));


                $qty += $quantity;

                $image_file = DB::table('colors_images')->select(['filename','alt_text'])->where('product_id', $product->id)->first();
                $image_filename = $image_alt_text = '';
                if ($image_file) {
                    $image_filename = '/img/products/drop/' . $image_file->filename;
                    $image_alt_text = $image_file->alt_text;
                }

                $item_qty = (int)$data[3]['value'];
                $item_total = (int)$data[3]['value'] * $price->price;

                $cart_content = SCart::getContent();
                $cart_subtotal = 0;
                foreach ($cart_content as $item) {
                    $cart_subtotal += (float)$item->price*(int)$item->quantity;
                }
                return response()->json(['response' => 'success','item_qty' => $item_qty,'item_total'=>$item_total,'cart_subtotal'=> $cart_subtotal, 'image_filename' => $image_filename, 'image_alt_text' => $image_alt_text, 'quantity_left' => ($attribute_color->available_qty - $qty), 'count'=>SCart::getTotalQuantity()]);
            }
        }
        return response()->json(['response' => 'No item left.'], 400);
    }
    /******************** ./Add To Cart Method ********************/

    public function updateQuantity(Request $request, $cartid)
    {
        SCart::update($cartid, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));


        return redirect()->back()->with('success', "Updated Successfully...");
    }

    /*
    |--------------------------------------------------------------------------
    |                               Cart Method
    |--------------------------------------------------------------------------
    */
    public function cart()
    {
        return view('frontend.pages.cart');
    }
    /******************** ./Cart Method ********************/

    /*
    |--------------------------------------------------------------------------
    |                               Cart Delete Method
    |--------------------------------------------------------------------------
    */
    public function deleteCart($cartid)
    {
        $response  = 0;
        $cart_content = SCart::getContent();
        if ($cart_content) {
            SCart::remove($cartid);
            return response()->json(['success' => true, 'response' => $response, 'count'=>SCart::getTotalQuantity()]);
        }
        return response()->json(['success' => false]);
    }
    /******************** ./Cart Delete Method ********************/
}
