<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'categories' => Category::orderBy('created_at', 'asc')->get(),
        ];

        return view('pages.admin.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'action' => route('category.store'),
        ];

        return view('pages.admin.kategori.create', $data);
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
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        // insert data category
        Category::create([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'description' => $request->description,
        ]);

        return redirect()->route('category.index');
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
            'category'  => Category::find($id),
            'action' => route('category.update', $id),
        ];

        return view('pages.admin.kategori.form', $data);
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
        // validasi field
        $validated = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'status' => 'required',
        ]);

        // update data caetegory
        Category::where('id', $id)->update([
            'name' => $validated['name'],
            'type' => $validated['type'],
            'status' => $validated['status'],
            'description' => $request->description,
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Category::findOrFail($id);
        $data->delete();

        return redirect()->route('category.index');
    }
}
