<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'products' => Product::orderBy('created_at', 'asc')->get(),
        ];

        return view('pages.admin.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'action' => route('product.store'),
            'categories' => Category::where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.admin.produk.create', $data);
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
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'condition' => 'required',
            'status' => 'required',
        ]);

        // mengecek apakah field untuk upload foto sudah upload atau belum
        if ($request->file('photo')) {
            $saveData['photo'] = Storage::putFile('public/product', $request->file('photo'));
        }

        // insert data category
        Product::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'photo' => $saveData['photo'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $request->description,
            'condition' => $validated['condition'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('product.index');
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
            'products'  => Product::find($id),
            'action' => route('product.update', $id),
            'categories' => Category::where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.admin.produk.form', $data);
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
        // get data photo product
        $data = Product::findOrFail($id);

        // fungsi validasi update product
        $validated = $request->validate([
            'category_id' => 'required|string',
            'name' => 'required',
            'photo' => 'mimes:jpg,jpeg,png,webp|max:10240',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'condition' => 'required',
            'status' => 'required',
        ]);

        // mengecek apakah field untuk upload photo sudah upload atau belum
        if ($request->file('photo')) {
            // hapus data photo sebelumnya terlbih dahulu
            Storage::delete($data->photo);

            // simpan photo yang baru
            $saveData['photo'] = Storage::putFile('public/product', $request->file('photo'));
        } else {
            $saveData['photo'] = $data->photo;
        }

        // validasi field satu persatu sebelum melakukan update
        Product::where('id', $id)->update([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'photo' => $saveData['photo'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $request->description,
            'condition' => $validated['condition'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::findOrFail($id);

        // hapus data foto
        Storage::delete($data->photo);

        // hapus data
        $data->delete();

        return redirect()->route('product.index');
    }
}
