<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Cart as SCart;

class CartComposer
{
    public $usercart;
    public $session_id;
    /**
     * Create a cart composer.
     *
     * @return void
     */
    public function __construct()
    {
    /*
    |--------------------------------------------------------------------------
    |                               Cart Method
    |--------------------------------------------------------------------------
    */

        $this->session_id = Session::get('session_id');

        if (!empty($this->session_id)) {


            $usercart = null;
        }

        /******************** ./Cart Method ********************/

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

      $cart_content = SCart::getContent();
      $subtotal = 0;
      foreach ($cart_content as $item) {
        $subtotal += (float)$item->price*(int)$item->quantity;
      }

      $data = [];
      $data['subtotal'] = $subtotal;
      $data['shipping'] = 0;
      $data['tax'] = 0;
      $data['shipping_discount'] = 0;
      $data['promo_code_text'] = '';

      foreach(SCart::getConditions() as $condition){

        if($condition->getType() == 'shipping'){
          $data['shipping'] = round($condition->getCalculatedValue($subtotal), 2);
        }

        if($condition->getType() == 'tax'){
          $data['tax'] = round($condition->getCalculatedValue($subtotal), 2);

        }

        if($condition->getType() == 'promo'){
          $data['shipping_discount'] = round($condition->getCalculatedValue($subtotal), 2);
          $attributes = $condition->getAttributes();
          $data['promo_code_text'] = $attributes['promo_code_text'];

        }

      }

      $data['total'] = $data['subtotal'] + $data['tax'] + $data['shipping'] - $data['shipping_discount'];


        if (!empty($this->session_id)) {
            $view->with('usercart', $this->usercart)
            ->with('scart', SCart::getContent())
            ->with('scart_subtotal', $subtotal)
            ->with('scart_total', $data['total'])
            ->with('scart_promo_discount', $data['shipping_discount'])
            ->with('scart_promo_code_text', $data['promo_code_text'])
            ->with('scart_shipping', $data['shipping'])
            ->with('scart_tax', $data['tax']);
        }
    }
}
