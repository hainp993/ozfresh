<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\OrderExport;

class OrderController
{
    public function index(Request $request)
    {


        $page = $request->query('page') ?? 1;
        $pageSize = $request->query('pageSize') ?? 25;

        $userId = $request->query('userId');

        $query = Order::query();

        $query =  $query->orderBy('id', 'desc')
            ->with('orderItems', 'orderItems.product')
            ->with('creator')
            ->with('customer');

        if ($userId != null) {
            $query = $query->where('orders.user_id', $userId);
        }

        $data =  $query
            ->skip(($page - 1) * $pageSize)
            ->take($pageSize)
            ->get();

        $total =  $query
            ->count();

        return response()->json([
            "total" => $total,
            "data" => $data,
        ]);
    }

    public function show($id)
    {

        $model = Order::where('id', $id)
            ->with('orderItems', 'orderItems.product')
            ->with('creator')
            ->with('customer')
            ->first();

        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        return response()->json($model);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'total' => 'required',
            'fullName' => 'required',
            'email' => 'email',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = $request->all();
        $model['creator_id'] = Auth::user()->id ?? null;
        $model = Order::create($model);

        if ($request->has('orderItems')) {
            foreach ($request->orderItems as $item) {

                $OrderItem = new OrderItem();
                $OrderItem->product_id = $item['product_id'];
                $OrderItem->quantity = $item['quantity'];
                $OrderItem->total = $item['total'];
                $OrderItem->order_id = $model->id;
                $OrderItem->save();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity -= $item['quantity'];
                $Product->save();
            }
        }

        return response()->json([
            "message" => "Thêm mới đơn hàng thành công",
        ]);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [

            'total' => 'required',
            'fullName' => 'required',
            'email' => 'email',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model =  Order::with('orderItems')->find($id);
        $model->status = $request->status;
        $model->ship_address = $request->ship_address;
        $model->note = $request->note;
        $model->fullName = $request->fullName;
        $model->phone = $request->phone;
        $model->email = $request->email;
        $model->total = $request->total;
        $model->user_id = $request->user_id;
        $model['creator_id'] = Auth::user()->id ?? null;

        if ($model->orderItems != null) {
            foreach ($model->orderItems as $item) {
                OrderItem::where("order_id", $item->order_id)
                    ->delete();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity += $item['quantity'];
                $Product->save();
            }
        }

        if ($request->has('orderItems')) {
            foreach ($request->orderItems as $item) {

                $OrderItem = new OrderItem();
                $OrderItem->product_id = $item['product_id'];
                $OrderItem->quantity = $item['quantity'];
                $OrderItem->total = $item['total'];
                $OrderItem->order_id = $model->id;
                $OrderItem->save();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity -= $item['quantity'];
                $Product->save();
            }
        }
        
        $model->save();
        return response()->json([
            "message" => "Cập nhật đơn hàng thành công",
        ]);


    }


    public function destroy($id)
    {
        $model = Order::find($id);
        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        $model->delete();
        return response()->json([
            "message" => "Xoá đơn hàng thành công",
        ]);
    }
}
