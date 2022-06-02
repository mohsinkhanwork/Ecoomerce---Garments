<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CollectionSlider as Slider;
use App\Collection;
use App\Product;
use App\ColorImage;
use App\DescriptionSlider;

class CollectionSliderController extends Controller
{
    public function index() {
        $collections = Collection::get();
        return view('admin.settings.slider.index', compact( 'collections' ) );
    }

    public function view( $collection_id ) {
        $collection = Collection::findOrFail( $collection_id );
        return view('admin.settings.slider.view', compact( 'collection' ) );
    }

    public function save( Request $request ) {
        $errors = [];

        foreach( $request->homepage_scroll_1 as $collection_id => $product_ids ) {
            foreach( $product_ids as $product_id => $color_image_ids ) {
                foreach( $color_image_ids as $color_image_id => $seconds ) {
                    $colorImage = ColorImage::find( $color_image_id );
                    if( $colorImage ) {
                        $colorImage->slider_scroll_1 = $seconds;
                        $colorImage->slider_scroll_2 = $request->homepage_scroll_2[$collection_id][$product_id][$color_image_id];
                        if( ! $colorImage->save() ) {
                            $errors[] = "Save failed for Home Page: Collection ID: $collection_id; Product ID: $product_id; Color Image ID: $color_image_id; Seconds: $seconds";
                        }
                    }
                }
            }
        }

        foreach( $request->description_scroll_1 as $collection_id => $product_ids ) {
            foreach( $product_ids as $product_id => $color_image_ids ) {
                foreach( $color_image_ids as $color_image_id => $slide_ids ) {
                    foreach( $slide_ids as $slide_id => $seconds ) {
                        $descriptionSlider = DescriptionSlider::find( $slide_id );
                        if( $descriptionSlider ){
                            $descriptionSlider->slider_scroll_1 = $seconds;
                            if( !$descriptionSlider->save() ) {
                                $errors[] = "Save failed for Home Page: Collection ID: $collection_id; Product ID: $product_id; Color Image ID: $color_image_id; Description Slider ID: $slide_id; Seconds: $seconds";
                            }
                        }
                    }
                }
            }
        }
        
        if( count( $errors ) > 0 ) {
            return redirect()->back()->withErrors( $errors );
        }
        return redirect()->back()->with('status', 'Slider times saved successfully.');
    }
}
