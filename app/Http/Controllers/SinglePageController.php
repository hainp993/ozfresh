<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\Product;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{
    public function index(Request $request)
    {

        $productHots = Product::with('user')->orderBy('sell_number','desc')->limit(10)->get();
        $productNews = Product::with('user')->orderBy('created_at','desc')->limit(10)->get();
        $postNews = BlogPost::with('user')->orderBy('created_at','desc')->limit(6)->get();
        return view('home',  [
            'productHots' => $productHots,
            'productNews' => $productNews,
            'postNews' => $postNews,
        ]);
    }

    public function info($slug)
    {
        $camp = Campaign::where("slug", $slug)->first();
        if ($camp == null) {
            return response()->json([
                "message" => "Không tìm thấy dữ liệu",
                "code" => -1,
            ]);
        }

        return response()->json([
            "code"=>0,
            "data"=>$camp
        ]);

    }
}
