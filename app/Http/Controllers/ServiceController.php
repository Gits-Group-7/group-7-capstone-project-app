<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'services' => Service::orderBy('created_at', 'asc')->get(),
        ];

        return view('pages.admin.jasa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'action' => route('service.store'),
            'categories' => Category::where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.admin.jasa.create', $data);
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
            'category_id' => 'required|string',
            'name' => 'required',
            'photo' => 'required|mimes:jpg,jpeg,png,webp|max:10240',
            'price_per_pcs' => 'required|numeric',
            'price_per_dozen' => 'required|numeric',
            'estimation' => 'required',
        ]);

        // mengecek apakah field untuk upload foto sudah upload atau belum
        if ($request->file('photo')) {
            $saveData['photo'] = Storage::putFile('public/service', $request->file('photo'));
        }

        // insert data category
        Service::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'photo' => $saveData['photo'],
            'price_per_pcs' => $validated['price_per_pcs'],
            'price_per_dozen' => $validated['price_per_dozen'],
            'estimation' => $validated['estimation'],
            'description' => $request->description,
        ]);

        return redirect()->route('service.index');
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
            'service'  => Service::find($id),
            'action' => route('service.update', $id),
            'categories' => Category::where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.admin.jasa.form', $data);
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
        // get data photo service
        $data = Service::findOrFail($id);

        // fungsi validasi update product
        $validated = $request->validate([
            'category_id' => 'required|string',
            'name' => 'required',
            'price_per_pcs' => 'required|numeric',
            'price_per_dozen' => 'required|numeric',
            'estimation' => 'required',
        ]);

        // mengecek apakah field untuk upload photo sudah upload atau belum
        if ($request->file('photo')) {
            // hapus data photo sebelumnya terlbih dahulu
            Storage::delete($data->photo);

            // simpan photo yang baru
            $saveData['photo'] = Storage::putFile('public/service', $request->file('photo'));
        } else {
            $saveData['photo'] = $data->photo;
        }

        // validasi field satu persatu sebelum melakukan update
        Service::where('id', $id)->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'photo' => $saveData['photo'],
            'price_per_pcs' => $validated['price_per_pcs'],
            'price_per_dozen' => $validated['price_per_dozen'],
            'estimation' => $validated['estimation'],
            'description' => $request->description,
        ]);

        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Service::findOrFail($id);

        // hapus data foto
        Storage::delete($data->photo);

        // hapus data
        $data->delete();

        return redirect()->route('service.index');
    }
}
