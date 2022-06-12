<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function overview(Request $request)
    {

        $user = $request->user();

        // check role shop 


        $end_date = Carbon::now();
        $start_date =  Carbon::now()->startOfMonth();

        // $totalDiscount = Order::whereBetween('created_at', [$start_date, $end_date])->sum('total');

        $totalDiscount = Order::sum('total');
        // $countNewCustomer = User::whereBetween('created_at', [$start_date, $end_date])->whereHas('roles', function ($q) {
        //     $q->where('name', '=', 'user');
        // })->count();

        $countNewCustomer = User::where('role', 'customer')->count();
        $countProduct = Product::count();
        $countNewOrder =  Order::count();
        $productHots = Product::orderBy('sell_number', 'desc')->take(6)->get();


        // $totalAmount = DB::select("select Date(created_at) date, sum(total) total 
        //                            from `orders` where `created_at` between '$start_date' and '$end_date' 
        //                            and status = 1
        //                            group by Date(created_at)
        //                            order by date
        //                            ");

        $totalAmount = DB::select("select Date(created_at) date, sum(total) total 
                                   from `orders` where `created_at` between '$start_date' and '$end_date' and status != 2
                                   group by Date(created_at)
                                   order by date
                                   ");
        // fill total amount

        $totalAmountFill = [];
        $dayStart = $start_date->day;
        $dayEnd = $end_date->day;

        while ($dayStart <= $dayEnd) {
            $dayStart++;
            $set = false;

            foreach ($totalAmount as $item) {
                $itemDate = new Carbon($item->date);
                if ($itemDate->day == $dayStart - 1) {
                    $totalAmountFill[] = ['day' => $dayStart - 1, 'total' => $item->total];
                    $set = true;
                }
            }
            if ($set) continue;
            $totalAmountFill[] = ['day' => $dayStart - 1, 'total' => 0];
        }



        $data['totalDiscount'] = $totalDiscount;
        $data['countNewCustomer'] = $countNewCustomer;
        $data['countProduct'] =  $countProduct;
        $data['countNewOrder'] = $countNewOrder;
        $data['productHots'] = $productHots;
        $data['totalAmount'] = $totalAmountFill;

        return response()->json([
            "data" => $data,
        ]);
    }
    public function revenue(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        $dataFill = [];
        $dayStart = $start_date ? (new Carbon($start_date)) : Carbon::now()->startOfMonth();
        $dayEnd = $end_date ? (new Carbon($end_date . ' 23:59')) : Carbon::now();

        $data = DB::select("select cast(o2.created_at as date) day, 
                                sum(o2.total) as totalAmount, 
                                count(o2.id) as totalOrder,  
                                sum(a.totalProduct) totalProduct, 
                                sum(case when o2.status = 1 then 1 else 0 end) totalOrderSuccess
                                from (
                                    select o.id, sum(oi.quantity) totalProduct 
                                    from orders o 
                                    join order_items oi 
                                    on o.id = oi.order_id 
                                    group by o.id
                                ) as a
                                join orders o2 
                                on o2.id = a.id
                                where  o2.created_at > '$dayStart' and '$dayEnd'
                                group by cast(o2.created_at as date)
                                order by day
                                ");
        // fill total amount
        while ($dayStart->lte($dayEnd)) {
            $set = false;
            foreach ($data as $item) {
                $itemDate = new Carbon($item->day);
                if ($itemDate == $dayStart) {
                    $dataFill[] =
                        [
                            'totalAmount'  => $item->totalAmount,
                            'totalOrder'  => $item->totalOrder,
                            'totalProduct'  => $item->totalProduct,
                            'totalOrderSuccess'  => $item->totalOrderSuccess
                        ];
                    $set = true;
                }
            }

            $dayStart->addDay();
            if ($set) continue;
            $dataFill[] =
                [
                    'totalAmount'  => 0,
                    'totalOrder'  => 0,
                    'totalProduct'  =>  0,
                    'totalOrderSuccess'  =>  0
                ];
        }


        return response()->json([
            "data" => $dataFill,
        ]);
    }
    public function employee(Request $request)
    {
        return 'employee';
    }
    public function customer(Request $request)
    {
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        $dataFill = [];
        $dayStart = $start_date ? (new Carbon($start_date)) : Carbon::now()->startOfMonth();
        $dayEnd = $end_date ? (new Carbon($end_date . ' 23:59')) : Carbon::now();

        $data = DB::select(" select  cast(o.created_at as date) day, 
                sum(case when cast(u.created_at as date)  <= cast(o.created_at as date) then 1 else 0 end) totalOldCustomer,
                sum(case when cast(u.created_at as date)  > cast(o.created_at as date) then 1 else 0 end) totalNewCustomer
                from orders o 
                join users u 
                on u.id  = o.user_id 
                where u.role = 'customer' and o.created_at > '$dayStart' and '$dayEnd'
                group by cast(o.created_at as date)
                order by day
        ");
        // fill total amount
        while ($dayStart->lte($dayEnd)) {
            $set = false;
            foreach ($data as $item) {
                $itemDate = new Carbon($item->day);
                if ($itemDate == $dayStart) {
                    $dataFill[] =
                        [
                            'totalOldCustomer'  => $item->totalOldCustomer,
                            'totalNewCustomer'  => $item->totalNewCustomer,
                        ];
                    $set = true;
                }
            }

            $dayStart->addDay();
            if ($set) continue;
            $dataFill[] =
                [
                    'totalOldCustomer'  => 0,
                    'totalNewCustomer'  => 0,
                ];
        }


        return response()->json([
            "data" => $dataFill,
        ]);
    }
}
