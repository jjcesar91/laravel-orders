<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Warehouse;
use App\Models\OrderStatus;
use App\Models\DetailStatus;
use Illuminate\Support\Arr;


use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function order($id, Request $request) {

        $order = Order::where('id',$id)->first();
        $cliente = Customer::where('code',$order->customer_code)->first();
        $agent = Agent::where('id',$order->agent_id)->first();
        $details = OrderDetail::where('order_id',$order->id)->get();
        $available_price = OrderDetail::where('order_id',$order->id)->where('stock','>','qty')->sum('price_tot');
        $topay_price = OrderDetail::where('order_id',$order->id)->where('status','<','5')->sum('price_tot');
        

        return view('order', [
            'order' => $order,
            'cliente' => $cliente,
            'agent' => $agent,
            'details' => $details,
            'topay_price' => $topay_price,
            'available_price' => $available_price
        ]);
    }

    public function update_orders_status(){

        $details = OrderDetail::where('id','>','0')->get();
        $orders = Order::where('id','>','0')->get();

        $arr_orders = [];

        foreach ($details as $detail) {
            if(!Arr::exists($arr_orders,$detail->order_id)){
                $arr_orders[$detail->order_id] = []; 
            }
            $arr_orders[$detail->order_id][] = $detail;
        }
        
        foreach ($orders as $order) {

            if(!Arr::exists($arr_orders,$order->id)){
                continue;
            }

            $order->status = 0;
            $all_complete = true;

            foreach ($arr_orders[$order->id] as $detail) {

                if($order->status == 0){
                    if($detail->status > 4){
                        $order->status = 1;
                    }
                }

                if(($detail->status >= 0)&&($detail->status < 5)){
                    $all_complete = false;
                }

            }

            if(($order->status == 1)&&($all_complete)){
                $order->status = 2;
            }

            $order->save();

        }

        dd("Stock correctly updated.");

    }

    public function update_details_status(){
        $details = OrderDetail::where('id','>','0')->get();
        $dstatus = DetailStatus::where('id','>','0')->get();
        $ostatus = OrderStatus::where('id','>','0')->get();

        $os_k = $ostatus->keyBy('order_id');
        $ds_k = collect($dstatus)->groupBy('order_prog');

        foreach ($details as $detail) {

            if(Arr::exists($os_k,$detail->order_id)){
                $prog = $os_k[$detail->order_id]->order_prog;

                if(Arr::exists($ds_k,$prog)){

                    foreach ($ds_k[$prog] as $ds) {
                        if($detail->order_row == ($ds->row-1)){
                            $detail->status = $ds->status[0];
                            $detail->save();
                        }
                    }

                }
            }
            

        }

        
        dd("Status correctly updated.");

    }

    public function update_orders_stock(){

        $details = OrderDetail::where('id','>','0')->get();
        $orders = Order::where('id','>','0')->get();

        $arr_orders = [];

        foreach ($details as $detail) {
            if(!Arr::exists($arr_orders,$detail->order_id)){
                $arr_orders[$detail->order_id] = []; 
            }
            $arr_orders[$detail->order_id][] = $detail;
        }
        
        foreach ($orders as $order) {

            if(!Arr::exists($arr_orders,$order->id)){
                continue;
            }

            $rows = count($arr_orders[$order->id]);
            $av_rows = 0;

            foreach ($arr_orders[$order->id] as $detail) {

                if($detail->available == 1){
                    $av_rows = $av_rows + 1;
                }

            }

            $perc = $av_rows/$rows*100;

            if($perc != $order->perc_complete){
                $order->perc_complete = $perc;
                $order->save();
            }

        }

        dd("Stock correctly updated.");
    }

    public function update_stock(){

        $details = OrderDetail::where('id','>','0')->get();
        $whs = Warehouse::where('qty','>','0')->get();

        $whs_k = $whs->keyBy('sku');
        

        foreach ($details as $detail) {
            $sku = $detail->sku;
            if(Arr::exists($whs_k,('P'.$sku))){
                if($detail->stock != $whs_k['P'.$sku]->qty){
                    $detail->stock = $whs_k['P'.$sku]->qty;

                    if(($detail->qty>$detail->stock)&&($detail->status<5)){
                        $detail->available = 0;
                    }else{
                        $detail->available = 1;
                    }

                    $detail->save();
                }
            }else if(Arr::exists($whs_k,$sku)){
                if($detail->stock != $whs_k[$sku]->qty){
                    $detail->stock = $whs_k[$sku]->qty;

                    if(($detail->qty>$detail->stock)&&($detail->status<5)){
                        $detail->available = 0;
                    }else{
                        $detail->available = 1;
                    }

                    $detail->save();
                }
            }else if(Arr::exists($whs_k,($sku.'/'))){
                if($detail->stock != $whs_k[$sku.'/']->qty){
                    $detail->stock = $whs_k[$sku.'/']->qty;

                    if(($detail->qty>$detail->stock)&&($detail->status<5)){
                        $detail->available = 0;
                    }else{
                        $detail->available = 1;
                    }

                    $detail->save();
                }
            }else if(Arr::exists($whs_k,(ltrim($sku, $sku[0])))){
                if($detail->stock != $whs_k[ltrim($sku, $sku[0])]->qty){
                    $detail->stock = $whs_k[ltrim($sku, $sku[0])]->qty;

                    if(($detail->qty>$detail->stock)&&($detail->status<5)){
                        $detail->available = 0;
                    }else{
                        $detail->available = 1;
                    }

                    $detail->save();
                }
            }else if(Arr::exists($whs_k,('0'.$sku))){
                if($detail->stock != $whs_k['0'.$sku]->qty){
                    $detail->stock = $whs_k['0'.$sku]->qty;

                    if(($detail->qty>$detail->stock)&&($detail->status<5)){
                        $detail->available = 0;
                    }else{
                        $detail->available = 1;
                    }

                    $detail->save();
                }
            }
            
        }

        dd("Stock correctly updated.");
    }

    public function product_list(Request $request) {



        return view('product_list', []);
    }

    public function products(Request $request) {

        $details = OrderDetail::where('id','>','0')->where('status','<','5')->get();

        $ds_k = collect($details)->groupBy('sku');
        $keys = $ds_k->keys();

        //$products = [];

        return view('products', [
            'products' => $ds_k,
            'skus' => $keys->all()
        ]);
    }


    public function orders(Request $request) {

        $orders = Order::where('id','>','0')->orderBy('id');
        $agents = Agent::where('id','>','0')->orderBy('name')->get();
        $customers = Customer::where('id','>','0')->orderBy('name')->get();

        $av_orders = Order::where('perc_complete','100')->where('status','<','2');
        $done_orders = Order::where('status','2');

        $k_agents = $agents->keyBy('id');
        $k_customers = $customers->keyBy('code');

        if ($request->input('agent') != '') {

            $orders->where('agent_id', $request->input('agent'));
            $done_orders->where('agent_id', $request->input('agent'));
            $av_orders->where('agent_id', $request->input('agent'));
        }

        if ($request->input('customer') != '') {

            $orders->where('customer_code', $request->input('customer'));
            $av_orders->where('customer_code', $request->input('customer'));
            $done_orders->where('customer_code', $request->input('customer'));
        }

        if ($request->input('min-price') != '') {

            $orders->where('final_price', '>=', $request->input('min-price'));
            $av_orders->where('final_price', '>=', $request->input('min-price'));
            $done_orders->where('final_price', '>=', $request->input('min-price'));
        }

        if ($request->input('max-price') != '') {

            $orders->where('final_price', '<=', $request->input('max-price'));
            $av_orders->where('final_price', '<=', $request->input('max-price'));
            $done_orders->where('final_price', '<=', $request->input('max-price'));
        }

        if ($request->input('min-perc') != '') {

            $orders->where('perc_complete', '>=', $request->input('min-perc'));
            $av_orders->where('perc_complete', '>=', $request->input('min-perc'));
            $done_orders->where('perc_complete', '>=', $request->input('min-perc'));
        }

        if ($request->input('max-perc') != '') {

            $orders->where('perc_complete', '<=', $request->input('max-perc'));
            $av_orders->where('perc_complete', '<=', $request->input('max-perc'));
            $done_orders->where('perc_complete', '<=', $request->input('max-perc'));
        }

        if ($request->input('ord-price') == '1') {

            $orders->orderBy('final_price');
        }

        if ($request->input('ord-price') == '2') {

            $orders->orderBy('final_price','DESC');
        }

        if ($request->input('ord-stock') == '1') {  
            
        }

        if ($request->input('ord-stock') == '2') {
               
        }

        if ($request->input('status') != '') {
            $orders->where('status', $request->input('status'));  
            $av_orders->where('status', $request->input('status'));  
            $done_orders->where('status', $request->input('status'));  
        }
        
        $orders2 = clone $orders;
        $totprice = $orders2->sum('final_price');

        return view('orders', [
            'agents' => $k_agents,
            'customers' => $k_customers,
            'orders' => $orders->get(),
            'filter' => $request->all(),
            'count' => $orders->count(),
            'av_orders' => $av_orders->count(),
            'done_orders' => $done_orders->count(),
            'totprice' => $totprice
        ]);
    }
}
