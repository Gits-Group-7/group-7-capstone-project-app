<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PromoBanner;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'promo_banners' => PromoBanner::orderBy('created_at', 'asc')->with('product')->with('service')->get(),
        ];

        return view('pages.admin.promo-banner.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'action' => route('promo.banner.store'),
            'products' => Product::orderBy('id', 'asc')->get(),
            'services' => Service::orderBy('id', 'asc')->get(),
        ];

        return view('pages.admin.promo-banner.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi field
        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,webp|max:10240',
            'status' => 'required',
        ]);

        // mengecek apakah field untuk upload foto sudah upload atau belum
        if ($request->file('photo')) {
            $saveData['photo'] = Storage::putFile('public/promo-banner', $request->file('photo'));
        }

        // insert data category
        PromoBanner::create([
            'title' => $validated['title'],
            'photo' => $saveData['photo'],
            'status' => $validated['status'],
            'product_id' => $request->product_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('promo.banner.index');
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
        $data = [
            'promo_banner'  => PromoBanner::find($id),
            'action' => route('promo.banner.update', $id),
            'products' => Product::orderBy('id', 'asc')->get(),
            'services' => Service::orderBy('id', 'asc')->get(),
        ];

        return view('pages.admin.promo-banner.form', $data);
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
        // get data photo promo banner
        $data = PromoBanner::findOrFail($id);

        // fungsi validasi update product
        $validated = $request->validate([
            'title' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,webp|max:10240',
            'status' => 'required',
        ]);

        // mengecek apakah field untuk upload photo sudah upload atau belum
        if ($request->file('photo')) {
            // hapus data photo sebelumnya terlbih dahulu
            Storage::delete($data->photo);

            // simpan photo yang baru
            $saveData['photo'] = Storage::putFile('public/promo-banner', $request->file('photo'));
        } else {
            $saveData['photo'] = $data->photo;
        }

        // validasi field satu persatu sebelum melakukan update
        PromoBanner::where('id', $id)->update([
            'title' => $validated['title'],
            'photo' => $saveData['photo'],
            'status' => $validated['status'],
            'product_id' => $request->product_id,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('promo.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PromoBanner::findOrFail($id);

        // hapus data foto
        Storage::delete($data->photo);

        // hapus data
        $data->delete();

        return redirect()->route('promo.banner.index');
    }
}
