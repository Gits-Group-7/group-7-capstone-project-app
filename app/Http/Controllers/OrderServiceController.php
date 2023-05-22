<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store_home($user_id, $service_id)
    {
        //  mengambil data service dan user customer
        $service = Service::find($service_id);
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        OrderService::create([
            'quantity' => 1,
            'total_price' => $service->price_per_pcs,
            'service_id' => $service->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('cart.index');
    }

    public function store_detail(Request $request, $user_id, $service_id)
    {
        // validasi field
        $validated = $request->validate([
            'material' => 'required',
            'quantity' => 'required|numeric',
        ]);

        //  mengambil data service dan user customer
        $service = Service::find($service_id);
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        OrderService::create([
            'material' =>  $validated['material'],
            'quantity' =>  $validated['quantity'],
            'total_price' =>  $validated['quantity'] * $service->price_per_pcs,
            'service_id' => $service->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('cart.index');
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
