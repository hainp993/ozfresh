<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CartPageController extends Controller
{
    public function index(Request $request)
    {
        return view('cart');
    }

    public function addCart(Request $request)
    {
        $id_sanpham = $request->id;
        $sanpham    = Product::find($request->id);

        if (is_object($sanpham)) {
            /**
             * 
             * Kiểm tra sách đã có trong giỏ hàng 
             */
            $so_luong_mua  = $request->get('so_luong') ?? 1;


            if ($request->session()->has('cart')) {


                $_SESSION['cart'] = $request->session()->get('cart');

                foreach ($_SESSION['cart'] as $product) {

                    if ($product->id == $id_sanpham) {
                        $_SESSION['cart'][$id_sanpham]->so_luong_mua = $product->so_luong_mua + $so_luong_mua;
                        $_SESSION['cart'][$product->id]->thanh_tien  =  $_SESSION['cart'][$id_sanpham]->so_luong_mua * ($product->gia_ban * ((100 - $product->sale) / 100));
                        $request->session()->put('cart',  $_SESSION['cart']);
                        return redirect('/cart');
                    } else {

                        /**
                         * Thành tiền = số lượng x giá sale
                         */
                        $thanh_tien            = $so_luong_mua * ($sanpham->gia_ban * ((100 - $sanpham->sale) / 100));  // cong thuc anh tinh ra thanh tien = gia ban * gia ban sale ./..
                        $sanpham->thanh_tien   = $thanh_tien;
                        $sanpham->so_luong_mua = $so_luong_mua;;

                        /**
                         * Thêm sách vào giỏ hàng
                         */
                        $_SESSION['cart'][$id_sanpham] = $sanpham;
                        $request->session()->put('cart',  $_SESSION['cart']);
                        return redirect('/cart');
                    }
                }
            }
            /**
             * Thành tiền = số lượng x giá sale
             */
            $thanh_tien            = $so_luong_mua * ($sanpham->gia_ban * ((100 - $sanpham->sale) / 100));  // cong thuc anh tinh ra thanh tien = gia ban * gia ban sale ./..
            $sanpham->thanh_tien   = $thanh_tien;
            $sanpham->so_luong_mua = $so_luong_mua;;

            /**
             * Thêm sách vào giỏ hàng
             */
            $_SESSION['cart'][$id_sanpham] = $sanpham;

            $request->session()->put('cart',  $_SESSION['cart']);

            return redirect('/cart');
        } else {
            echo ("LOI");
        }
    }

    public function removeProduct(Request $request)
    {
        if ($request->id && $request->session()->has('cart')) {
            $_SESSION['cart'] = $request->session()->get('cart');
            unset($_SESSION['cart'][$request->id]);
            $request->session()->put('cart',  $_SESSION['cart']);
            return redirect('/cart');
        } else {
            return redirect('/cart');
        }
    }

    public function checkout(Request $request)
    {

        $this->validate($request, [
            "hoten" => 'required',
            "email" => 'required|unique:users',
            "diachi" => 'required',
            "phone" => 'required|max:13|min:10'
        ],
        [
            'hoten.required' => 'Vui lòng nhập họ tên',
            'email.required' => 'Vui lòng nhập email',
            'diachi.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.max' => 'Số điện thoại không đúng định dạng',
            'phone.min' => 'Số điện thoại không đúng định dạng',
            'email.unique' => 'Email này đã được đăng kí, vui lòng đăng nhập tài khoản của bạn',
        ]);

        $_SESSION['cart'] = $request->session()->get('cart');

        $total = 0;
        if (is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart']  as $item) {
                $total += $item->so_luong_mua * $item->price;
            }
        }

        $don_hang=[];

        if (Auth::user()) {
            $customerId = Auth::user()->id;

            $profile = Profile::first('user_id', $customerId);
            if (!$profile) {
                Profile::create([
                    "user_id" => $customerId,
                    "name" => $request->hoten,
                    "avatar" => 'employee-avatar.png',
                    "address" => $request->diachi,
                    "phone" => $request->phone,
                ]);
            } else {
                $profile->phone = $request->phone;
                $profile->address = $request->diachi;
                $profile->save();
            }

            $don_hang = [
                'total'     => $total,
                'user_id' => $customerId,
                'fullName' => $request->hoten,
                'email' => $request->email,
                "ship_address" => $request->diachi,
                "phone" => $request->phone,
                "note" => $request->note ?? '',
                'status'    => 0,
            ];
        } else {

            $customer = User::create([
                "name" => "",
                "role" => "customer",
                "email" =>  $request->email,
                'password' => Hash::make($request->phone),
            ]);
            $profile =  Profile::create([
                "user_id" => $customer->id,
                "name" => $request->hoten,
                "avatar" => 'employee-avatar.png',
                "address" => $request->diachi,
                "phone" => $request->phone,
            ]);


            $don_hang = [
                'total'     => $total,
                'user_id' => $customer->id,
                'fullName' => $request->hoten,
                'email' => $request->email,
                "ship_address" => $request->diachi,
                "phone" => $request->phone,
                "note" => $request->note ?? " ",
                'status'    => 0,
            ];
        }

        $order = Order::create($don_hang);

        foreach ($_SESSION['cart'] as $product) {

            $chi_tiet = [
                'product_id' => $product->id,
                'order_id'   => $order->id,
                'quantity'   => $product->so_luong_mua,
                'price'      => $product->price,
                'sale'       => $product->sale,
                'total'      => ($product->price - ($product->price * $product->sale / 100)) * $product->quantity
            ];
            OrderItem::create($chi_tiet);

            $updateProduct = Product::find($product->id);
            $updateProduct->quantity -= $product->quantity;
            $updateProduct->save();
        }

        $request->session()->forget('cart');

        if($request->payment_method === 'vnpay'){
            return redirect ('/vnpay/checkout?orderId='.$order->id .'&total='.$don_hang['total'].'&note='. $don_hang['note']);
        }

        // redirect
        return redirect ('/cart/success');
    }

    public function success(){
         return view('order-success');
    }
}
