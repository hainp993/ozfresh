<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index(Request $request)
    {

        $page = $request->query('page') ?? 1;
        $pageSize = $request->query('pageSize') ?? 3;

        $data = Contact::when($request->has("search"), function ($q) use ($request) {
            $term = strtolower($request->search);
            return $q->whereRaw('lower(fullName) like (?) ',["%{$term}%"])
                     ->orWhereRaw('lower(message) like (?) ',["%{$term}%"])
                     ->orWhereRaw('lower(email) like (?) ',["%{$term}%"])
                    ;
        })
        ->when($request->has("status"), function ($q) use ($request) {
            return $q->where('status', '=', $request->status);
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


        $total = Contact::when($request->has("search"), function ($q) use ($request) {
            $term = strtolower($request->search);
            return $q->whereRaw('lower(fullName) like (?) ',["%{$term}%"])
                     ->orWhereRaw('lower(message) like (?) ',["%{$term}%"])
                     ->orWhereRaw('lower(email) like (?) ',["%{$term}%"])
                    ;
        })
        ->when($request->has("status"), function ($q) use ($request) {
            return $q->where('status', '=', $request->status);
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
            'fullName' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json(['error' => $validator->errors()], 400);
        }

        Contact::create($request->all());
        return response()->json([
            "message" => "Th??m m???i th??nh c??ng",
        ]);
    }

    public function show($id)
    {
        $model = Contact::find($id);
        if ($model == null) {
            return response()->json(['error' => "Kh??ng t??m th???y d??? li???u"], 400);
        }
        return response()->json($model);
    }

    public function update($id, Request $request)
    {
        $model = Contact::find($id);
        $model->status = $request->status;
        $model->save();
        return response()->json(["message" => "C???p nh???t th??nh c??ng"]);
    }

    public function destroy($id)
    {
        $model = Contact::find($id);
        if ($model == null) {
            return response()->json(['error' => "Kh??ng t??m th???y d??? li???u"], 400);
        }
        $model->delete();
        return response()->json([
            "message" => "Xo?? li??n h??? th??nh c??ng",
        ]);
    }
}
