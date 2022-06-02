<?php

namespace App\Http\Controllers;

use App\AttributeColors;
use App\CategorySlider;
use App\Category;
use App\CmsPagesModel;
use App\Collection;
use App\Product;
use App\ColorImage;
use App\ColorWiseCategorySlider;
use App\DescriptionSlider;
use App\ProductAttributes;
use Illuminate\Support\Facades\DB;
use App\ProductsAttributesColor;
use Cart as SCart;
use App\WebsiteSetting;

class IndexController extends Controller
{
    /**** Index Method ****/
    public function index()
    {
        $collections   = Collection::where(['status' => 1])->orderBy('order')->get();
        $products      = Product::all();

        $colors_images = DB::table('colors_images as ci')
            ->leftJoin('description_slider as ds', 'ci.id', '=', 'ds.color_id')
            ->leftJoin('category_slider as cs', 'ci.id', '=', 'cs.color_id')
            ->select(
                'ci.*',
                DB::raw('IFNULL(ds.id,0) as Description_Slider_ID'),
                DB::raw('IFNULL(cs.id,0) as Category_Slider_ID')
            )
            ->groupBy('ci.id')
            ->orderBy('ci.id', 'asc')
            ->get();

        $products_prices = DB::table('products_attributes')
            ->select(DB::raw('product_id, min(price) as min_price, max(price) as max_price'))
            ->groupBy('product_id')
            ->get();

        return view('frontend.index')->with(compact('collections', 'products', 'colors_images', 'products_prices'));
    }
    /**** ./ Index Method ****/

    /**** Category Method ****/
    public function category()
    {
        $category_colorwise_products = DB::table('colors_images')
            ->join('products', 'colors_images.product_id', '=', 'products.id')
            ->join('collections', 'products.collection_id', '=', 'collections.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('colors_images.id', 'colors_images.product_id', 'products.product_name', 'colors_images.color_name', 'collections.id as collection_id', 'collections.name as collection_name', 'categories.id as category_id', 'categories.name as category_name', 'products.alias')
            ->whereIn('products.collection_id', function ($query) {
                $query->select(DB::raw('id'))
                  ->from('collections')
                  ->where('status', 1);
            })
            ->whereIn('colors_images.id', function ($query) {
                $query->select(DB::raw('color_id'))
                    ->from('category_slider');
            })
            ->where('colors_images.show_to_option', 1)
            ->get();

        $session_id = \Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            \Session::put('session_id', $session_id);
        }

        $category_slider_images = CategorySlider::all();

        $category_colorwise_size_stock = DB::table('products_attributes')
            ->join('products_attributes_color', 'products_attributes.id', '=', 'products_attributes_color.attribute_id')
            ->select('products_attributes.id as pa_id', 'products_attributes.product_id', 'products_attributes_color.id as pac_id', 'products_attributes_color.color_id', 'products_attributes_color.attribute_id', 'products_attributes.size', 'products_attributes.price', 'products_attributes_color.color_stock', 'products_attributes_color.max_cart_qty')
            ->get();

        $collections   = Collection::where(['status' => 1])->orderBy('order')->get();

        //Get category id for filter (on left) on category pages.
        $filter_cat = Category::where('filter_cat', 'yes')->orderBy('display_order', 'asc')->get();


        //dd($filter_cat);

        return view('frontend.pages.category')->with(compact('category_colorwise_products', 'category_slider_images', 'category_colorwise_size_stock', 'collections', 'filter_cat'));

        /*return view('frontend.pages.category');*/
    }

    /** /Privacy Method */
    public function privacy(){
        $page = CmsPagesModel::find(1);
        return view("frontend.cmspage",compact('page'));
    }

    /** Terms method */

    public function terms(){
        $page = CmsPagesModel::find(2);
        return view("frontend.cmspage",compact('page'));
    }

    /**** ./ Category Method ****/

    /**** About Method ****/
    public function about()
    {
        return view('frontend.pages.about');
    }
    /**** ./ About Method ****/

    /**** FAQs Method ****/
    public function faqs()
    {
        return view('frontend.pages.faqs');
    }
    /**** ./ FAQs Method ****/

    /**** Contact Method ****/
    public function contact()
    {
        $phone = '203-881-6233';
        $setting = WebsiteSetting::where(['key'=>'contact_phone','name'=>'contact_phone'])->first();
        if(!empty($setting)){
            $phone = $setting['value'];
        }
        return view('frontend.pages.contact',['phone'=>$phone]);
    }
    /**** ./ Contact Method ****/

    /**** Description Method ****/
    public function viewDescription($alias, $color = '')
    {
        $product = Product::where(['alias' => $alias])->first();
        $pid = $product->id;
        $selected_color_id = '';

        $colors_images = ColorImage::where(['product_id' => $pid])
            ->whereIn('id', function ($query) {
                $query->select('color_id')
                    ->from('description_slider');
            })
            ->get();

        $products_prices = DB::table('products_attributes')
            ->select(DB::raw('product_id, min(price) as min_price, max(price) as max_price'))
            ->groupBy('product_id')
            ->having('product_id', $pid)
            ->get();

        $product_colors = ColorImage::where(['product_id'=> $pid,'show_to_option' => 1])->get();

        foreach ($product_colors as $key => $value) {
            if ($color != '' && $color == strtolower($value->color_name)) {
                $selected_color_id = $value->id;
            }
        }
        $description_slider = DB::table('description_slider')
            ->whereIn('color_id', function ($query) use ($pid) {
                $query->select('id')
                    ->from('colors_images')
                    ->where('colors_images.product_id', $pid);
            })
            ->orderBy('color_id')
            ->get();

        $description_sizechart_material = DB::table('categories')
            ->select('size_chart_image', 'material_care_instruction')
            ->where('id', function ($query) use ($pid) {
                $query->select('category_id')
                    ->from('products')
                    ->where('id', $pid);
            })
            ->get();

        //echo '<pre>'; print_r($description_sizechart_material); die();


        /*$description_slider = [];
        foreach ($colors_images as $colors_image) {
            $description_slider = DescriptionSlider::where(['color_id' => $colors_image->id])->get();
        }*/

        //echo '<pre>'; print_r($colors_images); die();

        return view('frontend.pages.description')->with(compact('product', 'colors_images', 'products_prices', 'description_slider', 'description_sizechart_material', 'product_colors', 'selected_color_id'));
    }
    /**** ./ Description Method ****/

    public function getDescriptionColorDropdown($aid)
    {
        $colors = DB::table('products_attributes_color')->where('attribute_id', $aid)->pluck('color_name', 'id');

        return json_encode($colors);
    }

    public function getDescriptionAttributeDropdown($color_id)
    {
        $sizes = ['1', 's', 'm', 'l', 'xl', '2xl', '3xl', '4xl'];
        $attributes = DB::table('products_attributes')
            ->join('products_attributes_color', function ($join) use ($color_id) {
                $join->on('products_attributes_color.attribute_id', '=', 'products_attributes.id')
                    ->where('products_attributes_color.color_id', $color_id);
            })
            ->select(DB::raw('products_attributes.id, products_attributes.size,products_attributes.price ,products_attributes_color.id AS attribute_color_id, products_attributes_color.color_stock, products_attributes_color.max_cart_qty'))
            ->orderByRaw('FIELD (products_attributes.size, "' . implode('", "', $sizes) . '") ASC')
            ->get();

        $session_id = \Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            \Session::put('session_id', $session_id);
        }

        $attr_arr = [];
        //return $attributes;
        if ($attributes) {
            foreach ($attributes as $key => $attribute) {
                $cart_content = SCart::getContent();
                $cart_quantity = 0;
                if ($cart_content) {
                    foreach ($cart_content as  $item) {
                        if ($item->attributes->attribute_color_id == $attribute->attribute_color_id) {
                            $cart_quantity = $item->quantity;
                        }
                    }
                }

                if ($attribute->max_cart_qty != 0 && $attribute->max_cart_qty < $attribute->color_stock) {
                    $attribute->color_stock = $attribute->max_cart_qty;
                }


                $attr_arr['attributes'][$key]['id'] = $attribute->id;
                $attr_arr['attributes'][$key]['size'] = $attribute->size;
                $attr_arr['attributes'][$key]['price'] = $attribute->price;
                $attr_arr['attributes'][$key]['attribute_color_id'] = $attribute->attribute_color_id;
                $attr_arr['attributes'][$key]['color_stock'] = $attribute->color_stock - $cart_quantity;
                $attr_arr['attributes'][$key]['cart_quantity'] = $cart_quantity;
            }
            $attr_arr['color_image'] = CategorySlider::where('color_id', $color_id)->first()->filename;
            $attr_arr['color_image_alt_text'] = CategorySlider::where('color_id', $color_id)->first()->alt_text;
            return json_encode($attr_arr);
        }
        return json_encode(['error' => 'No product size(s) found against this color.']);
    }



    public function getDescriptionQuantityDropdown($ids)
    {
        list($color_id, $attribute_id) = explode('_', $ids);

        $PAC = ProductsAttributesColor::where('color_id', $color_id)->where('attribute_id', $attribute_id)->first();
        $PAA = ProductAttributes::find($attribute_id);

        $session_id = \Session::get('session_id');
        if (empty($session_id)) {
            $session_id = str_random(40);
            \Session::put('session_id', $session_id);
        }

        $cart_quantity = 0;
        $cart_item = SCart::get($PAA->product_id ."_".$attribute_id."_".$PAC->id);

        if ($cart_item) {
            $cart_quantity = $cart_item->quantity;
        }

        $quantity = $PAC->available_qty - $cart_quantity;
        $quantity = $quantity < 0 ? 0 : $quantity;

        return json_encode([
            'stock' => $PAC->available_qty,
            'cart' => $cart_quantity,
            'left' => $quantity
        ]);
    }

    public function getDescriptionQuantityPrice($aid)
    {
        $price = DB::table('products_attributes')->where('id', $aid)->pluck('price', 'id');

        return json_encode($price);
    }

    public function getColorWiseCategoryGalleryImages($cid)
    {
        $colorwise_category_gallery_images = DB::table('colorwise_category_slider')
            ->select('filename')
            ->where('color_id', $cid)
            ->get();
        return response()->json($colorwise_category_gallery_images);
    }
}
