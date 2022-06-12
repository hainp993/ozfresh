<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WareHouseBill;
use App\Models\Product;
use App\Models\WareHouseBillItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\WareHouseBillExport;

class WareHouseBillController
{
    public function index(Request $request)
    {


        $page = $request->query('page') ?? 1;
        $pageWareHouseBill = $request->query('pageSize') ?? 25;
        $userId = $request->query('userId');

        $query = WareHouseBill::query();

        $query =  $query->orderBy('id', 'desc')
            ->with('billItems', 'billItems.product')
            ->with('user');

        if ($userId != null) {
            $query = $query->where('ware_house_bills.user_id', $userId);
        }

        $data =  $query
            ->skip(($page - 1) * $pageWareHouseBill)
            ->take($pageWareHouseBill)
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

        $model = WareHouseBill::where('id', $id)
            ->with('billItems', 'billItems.product')
            ->with('user')
            ->first();

        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        return response()->json($model);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'date' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model = $request->all();
        
        $model['user_id'] = Auth::user()->id ?? 1;
        $model = WareHouseBill::create($model);

        if ($request->has('billItems')) {
            foreach ($request->billItems as $item) {

                $WareHouseBillItem = new WareHouseBillItem();
                $WareHouseBillItem->product_id = $item['product_id'];
                $WareHouseBillItem->quantity = $item['quantity'];
                $WareHouseBillItem->amount = $item['amount'];
                $WareHouseBillItem->note = $item['note'];
                $WareHouseBillItem->bill_id = $model->id;
                $WareHouseBillItem->save();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity += $item['quantity'];
                $Product->save();
            }
        }

        return response()->json([
            "message" => "Thêm mới phiếu nhập thành công",
        ]);
    }

    public function update($id, Request $request)
    {

        $validator = Validator::make($request->all(), [

            'date' => 'required',
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        $model =  WareHouseBill::with('billItems')->find($id);

        $model->status = $request->status;
        $model->note = $request->note;
        $model->total = $request->total;
        $model->date = $request->date;
        $model['user_id'] = Auth::user()->id ?? 1;

        if ($model->billItems != null) {
            foreach ($model->billItems as $item) {
                WareHouseBillItem::where("bill_id", $item->bill_id)
                    ->delete();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity -= $item['quantity'];
                $Product->save();
            }
        }

        if ($request->has('billItems')) {
            foreach ($request->billItems as $item) {
                $WareHouseBillItem = new WareHouseBillItem();
                $WareHouseBillItem->product_id = $item['product_id'];
                $WareHouseBillItem->quantity = $item['quantity'];
                $WareHouseBillItem->amount = $item['amount'];
                $WareHouseBillItem->note = $item['note'];
                $WareHouseBillItem->bill_id = $model->id;
                $WareHouseBillItem->save();
                $Product = Product::where('id', $item['product_id'])->first();
                $Product->quantity += $item['quantity'];
                $Product->save();
            }
        }
        
        $model->save();
        return response()->json([
            "message" => "Cập nhật phiếu nhập thành công",
        ]);


    }


    public function destroy($id)
    {
        $model = WareHouseBill::find($id);
        if ($model == null) {
            return response()->json(['error' => "Không tìm thấy dữ liệu"], 400);
        }
        $model->delete();
        return response()->json([
            "message" => "Xoá phiếu nhập thành công",
        ]);
    }
}
