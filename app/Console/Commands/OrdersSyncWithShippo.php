<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Order;
use Shippo;
use Shippo_Order;
class OrdersSyncWithShippo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:syncwithshippo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Orders with Shippo';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if( env('APP_DEBUG') ) {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_TEST'));
        }
        else {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_LIVE'));
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $log = [
            'success' => [],
            'errors' => []
        ];
        $orders = Order::where('order_status', 2)->where('payment_status', 'Succeeded')->where('shippo_synced', 0)->get();
        if( $orders ) {
            foreach( $orders as $order ) {
                try {
                    $weight_orders = DB::table('orders')
                        ->join('orders_details', 'orders.id', '=', 'orders_details.order_id')
                        ->join('products', 'orders_details.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->where('orders.id', $order->id)
                        ->get();
                    $total_weight = 0;
                    if($weight_orders) {
                        foreach( $weight_orders as $weight_order ) {
                            $weight = $weight2 = 0;
                            $weight_unit = 'lb';
                            $weight_unit2 = 'oz';
                            if( str_replace('\'', '', $weight_order->weight ) != '' ){
                                list( $weight, $weight_unit, $weight2, $weight_unit2 ) = explode( '_', $weight_order->weight );
                            }
                            $total_weight += ($weight_unit == 'kg' ? $weight * 2.2046 : $weight);
                            $total_weight += $weight2 * 0.0625;
                        }
                    }
                    $line_items = [];
                    if($order->details) {
                        foreach($order->details as $detail) {
                            if( $detail->product ) {
        
                                $weight = $weight2 = $lb = 0;
                                $weight_unit = 'lb';
                                $weight_unit2 = 'oz';
                                if( str_replace('\'', '', $detail->product->category->weight ) != '' ){
                                    list( $weight, $weight_unit, $weight2, $weight_unit2 ) = explode( '_', $detail->product->category->weight );
                                }
                                $lb += ($weight_unit == 'kg' ? $weight * 2.2046 : $weight);
                                $lb += $weight2 * 0.0625;
                                $line_items[] = [
                                    'quantity' => $detail->quantity,
                                    'sku' => $detail->product->attributes->find( $detail->attribute_id ) ? $detail->product->attributes->find( $detail->attribute_id )->sku : '',
                                    'title' => $detail->product->product_name,
                                    'total_price' => number_format( $detail->price, 2 ),
                                    'currency' => 'USD',
                                    'weight' => number_format( $lb, 2 ),
                                    'weight_unit' => 'lb'
                                ];
                            }
                        }
                    }
        
                    if( $line_items ) {
                        $toAddress = [
                            'city' => ($order->customer ? $order->customer->shipping_city : ''),
                            'company' => '',
                            'country' => ($order->customer ? ($order->customer->shipping_country ? $order->customer->shipping_country : $order->country) : $order->country),
                            'email' => ($order->customer ? $order->customer->shipping_email : ''),
                            'name' => ($order->customer ? $order->customer->shipping_fullname : ''),
                            'phone' => '',
                            'state' => ($order->customer ? $order->customer->shipping_state : ''),
                            'street1' => ($order->customer ? $order->customer->shipping_address : ''),
                            'zip' => ($order->customer ? $order->customer->shipping_zip : '')
                        ];
        
                        $params = [
                            'to_address' => $toAddress,
                            'line_items' => $line_items,
                            'placed_at' => date('c', strtotime( $order->created_at ) ),
                            'order_number' => '#' . $order->id,
                            'order_status' => 'PAID',
                            'shipping_cost' => round( $order->shipping_rates, 2),
                            'shipping_cost_currency' => 'USD',
                            'shipping_method' => 'UPS',
                            'subtotal_price' => round( $order->cart_amount, 2),
                            'total_price' => round( $order->total_amount, 2),
                            'total_tax' => round( $order->sales_tax_rate, 2),
                            'currency' => 'USD',
                            'weight' => round( $total_weight, 2),
                            'weight_unit' => 'lb'
                        ];
                        $shippoOrder = Shippo_Order::create($params);
                        if( $shippoOrder && isset( $shippoOrder->object_id ) ) {
                            $order->shippo_synced = 1;
                            $order->shippo_synced_id = $shippoOrder->object_id;
                            $order->save();

                            $log['success'][] = 'Success: Order ID ' . $order->id . ' synced with shippo successfully.';
                        }
                    }
                }
                catch( \Exception $e ) {
                    $log['errors'][] = 'Error: An error occurd while syncing Order ID ' . $order->id . '. API said: ' . $e->getMessage();
                }
            }
        }
        
        if( count($log['success']) > 0 ) {
            foreach( $log['success'] as $message ) {
                echo "$message<br>";
                \Log::info( $message );
            }
        }
        if( count($log['errors']) > 0 ) {
            foreach( $log['errors'] as $message ) {
                echo "$message<br>";
                \Log::error( $message );
            }
        }
        if( count($log['success']) <= 0 && count($log['errors']) <= 0 ) {
            \Log::info( 'No order synced' );
        }
    }
}
