<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductPageController extends Controller
{
    public function index($slug, Request $request)
    {
        $product = Product::with('user')->where('slug', $slug)->first();
        $productNews = Product::with('user')->orderBy('created_at','desc')->limit(5)->get();
        return view('product-detail',  [
            'product' => $product,
            'productNews' => $productNews,
        ]);
    }
}
