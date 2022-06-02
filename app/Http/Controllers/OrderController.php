<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Notifications\OrderStatusChanged;
use App\OrdersDetail;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Shippo;
use Shippo_Order;

class OrderController extends Controller
{
    public function __construct() {
        if( env('SHIPPO_MODE') == 'test' ) {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_TEST'));
        }
        else {
            Shippo::setApiKey(env('SHIPPO_PRIVATE_LIVE'));
        }
    }
    public function viewOrder() {
        $orders = Order::where('archived', 0)->orderBy('id', 'desc')->get();
        $page = 'active_orders';
        return view('admin.pages.orders.view_order', compact('orders', 'page'));
    }

    public function viewArchivedOrder() {
        $orders = Order::where('archived', 1)->orderBy('id', 'desc')->get();
        $page = 'archived_orders';
        return view('admin.pages.orders.view_order', compact('orders', 'page'));
    }

    public function detailOrder($oid) {
        $order = Order::find($oid);
        $order_details = $customer = false;
        if( $order ) {
            $order_details = $order->details;
            $customer = $order->customer;
        }
        return view('admin.pages.partials.order_detail', compact( 'order', 'customer', 'order_details' ) )->render();
    }

    public function editMultipleOrders( Request $request ) {
        switch ($request->orders_action) {
            case 'delete':
                return $this->deleteMultipeOrders( $request->selected_orders );
                break;
            case 'archive':
            case 'unarchive':
                return $this->archiveMultipeOrders( $request->selected_orders, $request->orders_action );
                break;
            case 'export_archived':
            case 'export_active':
                return $this->exportMultipeOrders( ($request->orders_action=='export_archived'?1:0), $request->selected_orders );
                break;
            case 'status':
            default:
                return $this->changeMultipleOrderStatus( $request->selected_orders, $request->orders_action_status );
                break;
        }
    }

    public function deleteMultipeOrders( $orders ) {
        $errors = [];
        if( $orders && is_array( $orders ) && count( $orders ) > 0 ) {
            foreach( $orders as $order_id ) {
                $orderDetail = OrdersDetail::where('order_id',$order_id)->delete();
                $order = Order::find($order_id)->delete();
                if( !$orderDetail || !$order ) {
                    $errors[] = 'Something went wrong while deleting order ID : '.$order_id.', please try again later.';
                }
            }
        }
        else {
            $errors[] = 'Invlid orders delete request. No order(s) sent to delete.';
        }

        if( count( $errors ) > 0 ) {
            return redirect()->back()->withErrors($errors);
        }
        return redirect('/dashboard/manage-order')->with('status','Selected order(s) deleted successfully.');
    }

    public function archiveMultipeOrders( $orders, $archive ) {
        $errors = [];
        if( $orders && is_array( $orders ) && count( $orders ) > 0 ) {
            foreach( $orders as $order_id ) {
                $order = Order::find( $order_id );
                if( $order ) {
                    $order->archived = $archive == 'unarchive' ? 0 : 1;
                    if( $order->save() ) {
                        if( $order->customer ) {
                            $order_detail = [];
                            $order_detail['name'] = $order->customer->billing_fullname;
                            $order_detail['order_id'] = $order->id;
                            $order_detail['order_status'] = 'Archived';
                            Notification::route('mail', $order->customer->billing_email)->notify(new OrderStatusChanged($order_detail));
                        }
                        else {
                            $errors[$order->id] = 'Order send to archives. But, no customer data found to send notification of order ID: <strong><u>' . $order->id.'</u></strong>';
                        }
                    }
                    else {
                        $errors[$order->id] = 'Order status update failed of order ID: <strong><u>' . $order->id.'</u></strong>';
                    }
                }
                else {
                    $errors[$order->id] = 'No order found with order ID: <strong><u>' . $order->id.'</u></strong>';
                }
            }
        }
        else {
            $errors[] = 'Invlid orders archive request. No order(s) sent to archive.';
        }

        if( count( $errors ) > 0 ) {
            return redirect()->back()->withErrors($errors);
        }
        return redirect()->back()->with('status','Selected order(s) '.$archive.' successfully.');
    }

    public function exportMultipeOrders( $archived, $order_ids = 'all' ) {

        if( $archived === 'all' ) {
            $orders = Order::orderBy('id', 'asc')->get();
        }
        else {
            if( $order_ids && is_array( $order_ids) && count( $order_ids ) > 0 ){
                $orders = Order::whereIn('id', $order_ids)->where('archived', $archived)->orderBy('id', 'asc')->get();
            }
            else {
                $orders = Order::where('archived', $archived)->orderBy('id', 'asc')->get();
            }
        }

        $csvData = [];
        if( $orders ) {
            $csvHeader = [
                'Order Number',
                'Order Date',
                'Recipient Name',
                'Company',
                'Email',
                'Phone',
                'Street Line 1',
                'Street Number',
                'Street Line 2',
                'City',
                'State/Province',
                'Zip/Postal Code',
                'Country',
                'Item Title',
                'SKU',
                'Quantity',
                'Item Weight',
                'Item Weight Unit',
                'Item Price',
                'Item Currency',
                'Order Weight',
                'Order Weight Unit',
                'Order Amount',
                'Order Currency'
            ];

            $row = 0;
            foreach( $orders as $order ) {
                $weight_orders = DB::table('orders')
                                ->join('orders_details', 'orders.id', '=', 'orders_details.order_id')
                                ->join('products', 'orders_details.product_id', '=', 'products.id')
                                ->join('categories', 'products.category_id', '=', 'categories.id')
                                ->where('orders.id', $order->id)
                                ->get()
                                ;
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

                            $csvData[] = [
                                '#' . $order->id, // Order Number
                                date( 'm/d/Y', strtotime( $order->created_at ) ), // Order Date
                                ($order->customer ? $order->customer->shipping_fullname : ''), // Recipient Name
                                '', // Company
                                ($order->customer ? $order->customer->shipping_email : ''), // Email
                                '', // Phone
                                ($order->customer ? $order->customer->shipping_address : ''), // Street Line 1
                                '', // Street Number
                                '', // Street Line 2
                                ($order->customer ? $order->customer->shipping_city : ''), // City
                                ($order->customer ? $order->customer->shipping_state : ''), // State/Province
                                ($order->customer ? $order->customer->shipping_zip : ''), // Zip/Postal Code
                                ($order->customer ? ($order->customer->shipping_country ? $order->customer->shipping_country : $order->country) : $order->country), // Country
                                $detail->product->product_name, // Item Title
                                $detail->product->attributes->find( $detail->attribute_id ) ? $detail->product->attributes->find( $detail->attribute_id )->sku : '', // SKU
                                $detail->quantity, // Quantity
                                number_format( $lb, 2 ), // Item Weight
                                'lb', // Item Weight Unit
                                number_format( $detail->price, 2 ), // Item Price
                                'USD', // Item Currency
                                number_format( $total_weight, 2 ), // Order Weight
                                'lb', // Order Weight Unit
                                number_format( $order->total_amount, 2 ), // Order Amount
                                'USD' // Order Currency
                            ];
                            $row++;
                        }
                    }
                }
            }
            $filename ='orders.csv';
            header('Content-Type: text/csv; charset=utf-8');
            Header('Content-Type: application/force-download');
            header('Content-Disposition: attachment; filename='.$filename.'');

            $output = fopen('php://output', 'w');
            fputcsv($output, $csvHeader);
            foreach ($csvData as $row){
                fputcsv($output, $row);
            }
            fclose($output);
            exit;
        }
        return redirect()->back()->withErrors(['No orders found to export CSV.']);
    }

    public function syncOrdersWithShippo() {
        $synced_ids = $errors = [];
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
                            'shipping_method' => $order->shippo_provider,
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

                            $synced_ids[] = $order->id;
                        }
                    }
                }
                catch( \Exception $e ) {
                    $errors[] = 'Error: An error occurd while syncing Order ID ' . $order->id . '. API said: ' . $e->getMessage();
                }
            }
        }

        if( count($synced_ids) > 0 ) {
            \Session::flash('status', 'Orders <strong>'. implode(', ', $synced_ids) .'</strong> synced successfully.');
        }
        if( count($errors) > 0 ) {
            \Session::flash('errors', $errors);
        }
        if( count($synced_ids) <= 0 && count($errors) <= 0 ) {
            \Session::flash('status', 'No order synced.');
        }

        return redirect( url('/dashboard/manage-order') );
    }

    public function changeMultipleOrderStatus( $orders, $status_id ) {
        $order_status = [
            0 => '',
            1 => 'Pending',
            2 => 'In Process',
            3 => 'Dispatched',
            4 => 'Cancelled'
        ];
        $errors = [];
        if( $orders && is_array( $orders ) && count( $orders ) > 0 ) {
            foreach( $orders as $order_id ) {
                $order = Order::find( $order_id );
                if( $order ) {
                    $order->order_status = $status_id;
                    if( $order->save() ) {
                        if( $order->customer ) {
                            $order_detail = [];
                            $order_detail['name'] = $order->customer->billing_fullname;
                            $order_detail['order_id'] = $order->id;
                            $order_detail['order_status'] = $order_status[ $status_id ];
                            Notification::route('mail', $order->customer->billing_email)->notify(new OrderStatusChanged($order_detail));
                        }
                        else {
                            $errors[$order->id] = 'Order status change to <strong><u>'.$order_status[$status_id].'</u></strong>. But, no customer data found to send notification of order ID: <strong><u>' . $order->id.'</u></strong>';
                        }
                    }
                    else {
                        $errors[$order->id] = 'Order status update failed of order ID: <strong><u>' . $order->id.'</u></strong>';
                    }
                }
                else {
                    $errors[$order->id] = 'No order found with order ID: <strong><u>' . $order->id.'</u></strong>';
                }
            }
        }
        else {
            $errors[] = 'Invlid orders status change request. No order(s) sent to change status.';
        }

        if( count( $errors ) > 0 ) {
            return redirect()->back()->withErrors($errors);
        }
        return redirect('/dashboard/manage-order')->with('status','Selected order(s) statuses changed to <strong><u>'.$order_status[$status_id].'</u></strong> successfully.');
    }

    public function deleteOrder($oid) {
        $orderDetail = OrdersDetail::where('order_id',$oid)->delete();
        $order = Order::find($oid)->delete();
        if($orderDetail && $order) {
            return redirect('/dashboard/manage-order')->with('status','Order has been deleted successfully');
        } else {
            $error = array('error' => 'Invalid delete request!');
            return redirect()->back()->withErrors($error);
        }
    }

    public function statusOrder($oid, $sid, $cid) {
        $status = Order::where('id', $oid)->update(['order_status' => $sid]);
        $order = Order::where('id', $oid)->first();
        $customer = Customer::where('id', $cid)->first();
        $order_detail = [];
        $order_detail['name'] = $customer->billing_fullname;
        $order_detail['order_id'] = $order->id;
        $order_detail['order_status'] = ($order->order_status == 1 ? 'Pending' : ($order->order_status == 2 ? 'In Process' : ($order->order_status == 3 ? 'Dispatched' : ($order->order_status == 4 ? 'Cancelled' : '' ))));
        if($status) {
            Notification::route('mail', $customer->billing_email)
                ->notify(new OrderStatusChanged($order_detail));
            return response()->json(['message' => 'success','code' => '200']);
        } else {
            return response()->json(['message' => 'failed','code' => '400']);
        }


    }

}
