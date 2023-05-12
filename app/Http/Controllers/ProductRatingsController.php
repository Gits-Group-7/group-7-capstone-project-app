<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingsController extends Controller
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
    public function store(Request $request, $product_id, $user_id)
    {
        // Get authenticated user
        $user = Auth::user();

        // Check if the authenticated user is a customer
        if ($user->role !== 'customer') {
            abort(403, 'Unauthorized action.');
        }

        // Get the user data
        $userData = User::findOrFail($user_id);

        // Get the product data
        $productData = Product::findOrFail($product_id);

        // Validate the request data
        $validated = $request->validate([
            'rating' => 'required|numeric',
        ]);

        // Create a new shop rating record
        ProductRating::create([
            'rating' => $validated['rating'],
            'comment' => $request->comment,
            'product_id' => $productData->id,
            'user_id' => $userData->id,
        ]);

        return redirect()->route('customer.product.detail', $productData->id);
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
