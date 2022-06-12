<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::with('user')->orderBy('id', 'desc')->paginate(3);

        return view('blog', [
            'posts' => $posts,
        ]);
    }

    public function detail($slug, Request $request)
    {
        $post = BlogPost::with('user')->where('slug', $slug)->first();
        $productNews = BlogPost::with('user')->orderBy('created_at','desc')->limit(5)->get();
        return view('blog-detail',  [
            'post' => $post,
            'productNews' => $productNews,
        ]);
    }
}
