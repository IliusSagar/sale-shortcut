<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function findProductsSales(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $products = Product::where("code", "LIKE", "%" . $request->search . "%")->take(10)->get();

        return view('search-product', compact('products'));

    }
}