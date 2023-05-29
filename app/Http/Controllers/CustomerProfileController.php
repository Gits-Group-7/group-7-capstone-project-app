<?php

namespace App\Http\Controllers;

use App\Models\TrackingLog;
use App\Models\TransactionOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerProfileController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // hanya user dengan id yang sesuai dengan user yang sedang login yang dapat mengakses halaman profil
        if (Auth::user()->id != $id) {
            abort(404);
        }

        $data = [
            'action' => route('customer.profile.update', $id),
            'customer' => User::findOrFail($id),
        ];

        return view('pages.user.profile-user', $data);
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
        $data = User::findOrFail($id);

        // perintah update profile admin
        $validated = $request->validate([
            'name' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,webp|max:10240',
            'birthdate' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        // mengecek apakah field untuk upload foto sudah upload atau belum
        if ($request->file('photo')) {
            // hapus data foto sebelumnya terlbih dahulu
            Storage::delete($data->photo);

            // simpan foto yang baru
            $saveData['photo'] = Storage::putFile('public/user', $request->file('photo'));
        } else {
            $saveData['photo'] = $data->photo;
        }

        // validasi field satu persatu sebelum melakukan update
        User::where('id', $id)->update([
            'name' => $validated['name'],
            'photo' =>  $saveData['photo'],
            'birthdate' => $validated['birthdate'],
            'gender' => $validated['gender'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('customer.profile', $data);
    }

    public function transaction_product_accepted($transaction_order_id)
    {
        // update transaksi order
        TransactionOrder::where('id', $transaction_order_id)->update([
            'status_delivery' => 'Completed Order',
            'order_note' => 'Pesanan Diterima',
            'delivery_complete' => 'Yes',
        ]);

        // Mengambil data transaksi order
        $transactionOrder = TransactionOrder::findOrFail($transaction_order_id);

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'location' => $transactionOrder->track_delivery_location,
            'note' => 'Pesanan Diterima',
            'status' => 'Completed Order',
            'is_complete' => 'Yes',
            'transaction_order_id' => $transaction_order_id,
        ]);

        return redirect()->route('customer.transaction.product', auth()->user()->id);
    }

    public function order_service_accepted($transaction_order_id)
    {
        // update transaksi order
        TransactionOrder::where('id', $transaction_order_id)->update([
            'status_delivery' => 'Completed Order',
            'order_note' => 'Pesanan Diterima',
            'delivery_complete' => 'Yes',
        ]);

        // Mengambil data transaksi order
        $transactionOrder = TransactionOrder::findOrFail($transaction_order_id);

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'location' => $transactionOrder->track_delivery_location,
            'note' => 'Pesanan Diterima',
            'status' => 'Completed Order',
            'is_complete' => 'Yes',
            'transaction_order_id' => $transaction_order_id,
        ]);

        return redirect()->route('customer.order.service', auth()->user()->id);
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
