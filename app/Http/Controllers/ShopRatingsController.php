<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ShopRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ShopRatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'ratings' => ShopRating::paginate(5),
            'rating_count' => ShopRating::count(),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];
        return view('pages.customer.rating-toko.daftar-ulasan-toko', $data);
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
    public function store(Request $request, $id)
    {
        // Get authenticated user
        $user = Auth::user();

        // Check if the authenticated user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'Unauthorized action.');
        }

        // Get the user data
        $userData = User::findOrFail($id);

        // Validate the request data
        $validated = $request->validate([
            'rating' => 'required|numeric',
        ]);

        // Create a new shop rating record
        ShopRating::create([
            'rating' => $validated['rating'],
            'comment' => $request->comment,
            'user_id' => $userData->id,
        ]);

        return redirect()->route('customer.store.rating');
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
