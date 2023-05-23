<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request, $service_id)
    {
        // get data foto custom design service
        $data = OrderService::findOrFail($service_id);

        // mengambil data price service
        $order = OrderService::find($service_id);
        $searchService = $order->service_id;
        $price = Service::where('id', $searchService)->value('price_per_pcs');

        // mengambil data field quantity
        $quantity = $request->input('quantity');
        $fix_quantity = intval($quantity);

        // validasi field
        $validated = $request->validate([
            'is_checkout_service' => 'required',
            'quantity' => 'required|numeric',
            'material' => 'required',
            'custom_design' => 'nullable|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // mengecek apakah field untuk upload photo sudah upload atau belum
        if ($request->file('custom_design')) {
            // hapus data photo sebelumnya terlbih dahulu
            Storage::delete($data->custom_design);

            // simpan photo yang baru
            $saveData['custom_design'] = Storage::putFile('public/custom-design', $request->file('custom_design'));
        } else {
            $saveData['custom_design'] = $data->custom_design;
        }

        // validasi field satu persatu sebelum melakukan update
        OrderService::where('id', $service_id)->update([
            'is_checkout' => $validated['is_checkout_service'],
            'quantity' => $validated['quantity'],
            'material' => $request->material,
            'custom_design' => $saveData['custom_design'],
            'deadline' => $request->deadline,
            'total_price' => $price * $fix_quantity,
        ]);

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($service_id)
    {
        $data = OrderService::findOrFail($service_id);

        // Cek jika field 'custom_design' tidak bernilai null
        if ($data->custom_design != null) {
            // Hapus data foto
            Storage::delete($data->custom_design);
        }

        // Hapus data
        $data->delete();

        return redirect()->route('cart.index');
    }
}
