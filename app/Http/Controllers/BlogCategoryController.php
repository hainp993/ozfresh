<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->query('page') ?? 1;
        $pageSize = $request->query('pageSize') ?? 3;

        $data = BlogCategory::when($request->has("search"), function ($q) use ($request) {
            $term = strtolower($request->search);
            return $q->whereRaw('lower(name) like (?) ', ["%{$term}%"])
                     ->orWhereRaw('lower(slug) like (?) ', ["%{$term}%"])
                     ->orWhereRaw('lower(description) like (?) ', ["%{$term}%"])
                    ;
            })
            ->when($request->has("start_date"), function ($q) use ($request) {
                return $q->where('created_at', '>=', $request->start_date);
            })
            ->when($request->has("end_date"), function ($q) use ($request) {
                return $q->where('created_at', '<=', $request->end_date);
            })
            ->orderBy('id', 'desc')
            ->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();


        $total = BlogCategory::when($request->has("search"), function ($q) use ($request) {
            $term = strtolower($request->search);
            return $q->whereRaw('lower(name) like (?) ', ["%{$term}%"])
                     ->orWhereRaw('lower(slug) like (?) ', ["%{$term}%"])
                     ->orWhereRaw('lower(description) like (?) ', ["%{$term}%"])
                    ;
            })
            ->when($request->has("start_date"), function ($q) use ($request) {
                return $q->where('created_at', '>=', $request->start_date);
            })
            ->when($request->has("end_date"), function ($q) use ($request) {
                return $q->where('created_at', '<=', $request->end_date);
            })
            ->count();

        return response()->json([
            "total" => $total,
            "data" => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'unique:blog_categories'
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = $request->all();

        if (!$request->has("slug") || !isset($request->slug) || $request->slug == "" || $request->slug == null) {
            $model['slug'] = Str::slug($request->name);
        }

        BlogCategory::create($model);
        return response()->json([
            "message" => "Th??m m???i th??nh c??ng",
        ]);
    }

    public function show($id)
    {
        $model = BlogCategory::find($id);
        if ($model == null) {
            return response()->json(['error' => "Kh??ng t??m th???y d??? li???u"], 400);
        }
        return response()->json($model);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'unique:blog_categories'
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = BlogCategory::find($id);
        $model->name = $request->name;
        $model->slug = $request->slug;
        $model->description = $request->description;
        $model->save();
        return response()->json(["message" => "C???p nh???t th??nh c??ng"]);
    }

    public function destroy($id)
    {
        $model = BlogCategory::find($id);
        if ($model == null) {
            return response()->json(['error' => "Kh??ng t??m th???y d??? li???u"], 400);
        }
        $model->delete();
        return response()->json([
            "message" => "Xo?? th??? lo???i th??nh c??ng",
        ]);
    }
}
