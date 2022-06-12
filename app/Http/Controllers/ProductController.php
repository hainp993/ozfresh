<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->query('page') ?? 1;
        $pageSize = $request->query('pageSize') ?? 100;

        $data = Product::with("user")
            ->with("categories")
            ->when($request->has("search"), function ($q) use ($request) {
                $term = strtolower($request->search);
                return $q->whereRaw('lower(name) like (?) ', ["%{$term}%"])
                    ->orWhereRaw('lower(slug) like (?) ', ["%{$term}%"])
                    ->orWhereRaw('lower(description) like (?) ', ["%{$term}%"]);
            })
            ->when($request->has("status"), function ($q) use ($request) {
                return $q->where('status', '=', $request->status);
            })
            ->when($request->has("user_id"), function ($q) use ($request) {
                return $q->where('user_id', '=', $request->user_id);
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


        $total = Product::when($request->has("search"), function ($q) use ($request) {
            $term = strtolower($request->search);
            return $q->whereRaw('lower(name) like (?) ', ["%{$term}%"])
                ->orWhereRaw('lower(slug) like (?) ', ["%{$term}%"])
                ->orWhereRaw('lower(description) like (?) ', ["%{$term}%"]);
        })
            ->when($request->has("user_id"), function ($q) use ($request) {
                return $q->where('user_id', '=', $request->user_id);
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
            'thumbnail' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = $request->all();
        $model['sale'] = $request->sale ?? 0;

        if (!$request->has("slug") || !isset($request->slug) || $request->slug == "" || $request->slug == null) {
            $model['slug'] = Str::slug($request->name);
        }

        $model['user_id'] = Auth::user()->id ?? 1;
        $model = Product::create($model);

        if ($request->has("categories")) {
            foreach ($request->categories as $item) {
                $item['product_id'] = $model->id;
                ProductProductCategory::create($item);
            }
        }

        return response()->json([
            "message" => "Thêm mới thành công",
        ]);
    }

    public function show($id)
    {
        $model = Product::with("user")
            ->with("categories")
            ->find($id);
        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        return response()->json($model);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'thumbnail' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = Product::with('categories')->find($id);
        $model->name = $request->name;
        $model->thumbnail = $request->thumbnail;
        $model->slug = $request->slug;
        $model->sale = $request->sale;
        $model->price = $request->price;
        $model->quantity = $request->quantity;
        $model->description = $request->description;
        $model['user_id'] = Auth::user()->id ?? 1;

        if (!$request->has("slug") || !isset($request->slug) || $request->slug == "" || $request->slug == null) {
            $model->slug = Str::slug($request->name);
        }

        if($model->categories != null) {
            foreach ($model->categories as $item) { 
                ProductProductCategory::where("category_id",$item->pivot->category_id)
                                 ->where("product_id", $item->pivot->product_id)->delete();
            }
        }


        if ($request->has("categories")) {
            foreach ($request->categories as $item) {
                $item['product_id'] = $model->id;
                ProductProductCategory::create($item);
            }
        }


        $model->save();
        return response()->json(["message" => "Cập nhật thành công"]);
    }

    public function destroy($id)
    {
        $model = Product::find($id);
        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        $model->delete();
        return response()->json([
            "message" => "Xoá sách thành công",
        ]);
    }
}
