<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\TransactionOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // transaction customer
        $customerId = auth()->user()->id;
        $transaction_product_customers = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'product')->where('order_confirmed', 'No')->orderBy('order_date', 'desc')->get();
        $order_service_customers = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'service')->where('order_confirmed', 'No')->orderBy('order_date', 'desc')->get();

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),
        ];

        return view('pages.customer.tranksaksi.transaction-order', $data, compact('transaction_product_customers', 'order_service_customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    public function transaction_store_product($user_id)
    {
        // mengambil data user customer
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'product',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    public function order_store_service($user_id)
    {
        // mengambil data user customer
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'service',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
