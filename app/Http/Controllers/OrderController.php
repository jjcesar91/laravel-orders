<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function order($id, Request $request) {
        $orders = json_decode(file_get_contents(storage_path('demo-data/orders.json')), true);
        $customers = json_decode(file_get_contents(storage_path('demo-data/customers.json')), true);
        $agents = json_decode(file_get_contents(storage_path('demo-data/agents.json')), true);
        $details = json_decode(file_get_contents(storage_path('demo-data/order_details.json')), true);

        $order = collect($orders)->firstWhere('id', $id);
    $cliente = collect($customers)->firstWhere('id', $order['customer_id']);
    $agent = collect($agents)->firstWhere('id', $order['agent_id']);
    $order_details = collect($details)->where('order_id', $order['id'])->all();
    $available_price = collect($order_details)->filter(function($d){ return ($d['stock'] ?? 0) > ($d['qty'] ?? 0); })->sum('price');
    $topay_price = collect($order_details)->filter(function($d){ return ($d['status'] ?? 0) < 5; })->sum('price');

        return view('order', [
            'order' => $order,
            'cliente' => $cliente,
            'agent' => $agent,
            'details' => $order_details,
            'topay_price' => $topay_price,
            'available_price' => $available_price
        ]);
    }

    public function update_orders_status(){
        // Solo demo: nessuna modifica persistente
        return response('Demo: nessuna modifica persistente.', 200);
    }

    public function update_details_status(){
        // Solo demo: nessuna modifica persistente
        return response('Demo: nessuna modifica persistente.', 200);
    }

    public function update_orders_stock(){
        // Solo demo: nessuna modifica persistente
        return response('Demo: nessuna modifica persistente.', 200);
    }

    public function update_stock(){
        // Solo demo: nessuna modifica persistente
        return response('Demo: nessuna modifica persistente.', 200);
    }

    public function product_list(Request $request) {
        $details = collect(json_decode(file_get_contents(storage_path('demo-data/order_details.json')), true));
        return view('product_list', ['details' => $details]);
    }

    public function products(Request $request) {
        $details = collect(json_decode(file_get_contents(storage_path('demo-data/order_details.json')), true))->filter(function($d){ return ($d['status'] ?? 0) < 5; });
        $ds_k = $details->groupBy('product');
        $keys = $ds_k->keys();
        return view('products', [
            'products' => $ds_k,
            'skus' => $keys->all()
        ]);
    }


    public function orders(Request $request) {
        $orders = collect(json_decode(file_get_contents(storage_path('demo-data/orders.json')), true));
        $agents = collect(json_decode(file_get_contents(storage_path('demo-data/agents.json')), true))->keyBy('id');
        $customers = collect(json_decode(file_get_contents(storage_path('demo-data/customers.json')), true))->keyBy('id');

        $filtered = $orders;
        if ($request->input('agent') != '') {
            $filtered = $filtered->where('agent_id', $request->input('agent'));
        }
        if ($request->input('customer') != '') {
            $filtered = $filtered->where('customer_id', $request->input('customer'));
        }
        if ($request->input('min-price') != '') {
            $filtered = $filtered->filter(fn($o) => $o['total'] >= $request->input('min-price'));
        }
        if ($request->input('max-price') != '') {
            $filtered = $filtered->filter(fn($o) => $o['total'] <= $request->input('max-price'));
        }
        if ($request->input('status') != '') {
            $filtered = $filtered->where('status', $request->input('status'));
        }

        $totprice = $filtered->sum('total');

        return view('orders', [
            'agents' => $agents,
            'customers' => $customers,
            'orders' => $filtered->values(),
            'filter' => $request->all(),
            'count' => $filtered->count(),
            'av_orders' => $orders->where('status', 'in lavorazione')->count(),
            'done_orders' => $orders->where('status', 'completato')->count(),
            'totprice' => $totprice
        ]);
    }
}
