<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function index(Request $request)
    {
        $categorySlug = $request->category;
        $searchKey = $request->q;

        $query = Product::with('user');

        $category  = null;

        if($categorySlug){
            
            $category = ProductCategory::where('slug', $categorySlug)->first();
            $query = $query->whereHas('categories', function (Builder $q) use ($category) {
                $q->where('category_id', $category->id);
            });
        }

        if($searchKey){
            $query = $query->whereRaw('lower(name) like (?) ', ["%{$searchKey}%"]);
        }

        $total = $query->count();
        $posts = $query->orderBy('id', 'desc')->paginate(4);

        return view('shop', [
            'searchKey' => $searchKey,
            'posts' => $posts,
            'total' => $total,
            'category' => $category
        ]);
    }

}
