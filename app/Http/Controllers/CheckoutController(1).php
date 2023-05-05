<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\Order;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $infoCus = DB::table('customer')->whereRaw("id =" . request()->cookie("cusId"))->first();
        $cart = DB::table("cart")->join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->join("shoes", "shoes_size.shoes_id", "=", "shoes.id")->where("customer_id", "=", request()->cookie("cusId"))->get();
        return view("client.checkout", compact("infoCus", "cart"));
    }
    public function checkoutTwo(Request $request)
    {
        $count_cart = CartModel::where("customer_id", "=", request()->cookie("cusId"))->get();
        $count_cart = $count_cart->count();
        if($count_cart===0){
            session()->flash("err", "Không có sản phẩm nào trong Giỏ hàng!!! Mời bạn thêm sản phẩm vào giỏ hàng");
            return redirect()->back();
        }

        session()->put("countCart", $count_cart);
        session()->put("subtotal", $request->subtotal);
        session()->put("shipping", $request->shipping);
        session()->put("total", $request->total);
        session()->put("discount_save", $request->discount_save);
        return redirect()->action([CheckoutController::class, "index"]);
    }
    public function checkoutThree(Request $request, $id)
    {
        
        echo "<pre>";
        print_r(request()->all());
        echo "</pre>";

        $mess = [

            "accept.required" => "Bạn phải chấp nhận tất cả điều khoản!!!",
            "optradios.required" => "Bạn hãy chọn phương thức thanh toán!!!",
        ];
        $request->validate([
            "accept" => "required",
            "optradios" => "required",
        ], $mess);
        $cart = DB::table("cart")->join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->join("shoes", "shoes_size.shoes_id", "=", "shoes.id")->where("customer_id", "=", request()->cookie("cusId"))->get();
        $info = DB::table("customer")->whereRaw("id =" . $id)->first();
        // $ordered = Order::whereRaw("customer_id =" . $id)->first();
        if ($request->optradio == "0" || $request->optradio === null) {
            //dung bằng thông tin đã có 
            $order = new Order();
            $order->customer_id = $id;
            $order->status = 1;
            $order->total_payment = session("total");
            $order->note = "Đặt Hàng ủng hộ Shopp!!!";
            $order->receiver_name = $info->fullname;
            $order->receiver_tel = $info->phone;
            $order->receiver_add = $info->address;
            $order->save();


            foreach ($cart as $c) {
                $orderdetail = new OrderModel();
                $orderdetail->order_id = $order->id;
                $orderdetail->shoes_size_id = $c->shoes_size_id;
                $orderdetail->price = $c->price;
                $orderdetail->quantity = $c->quantity_cart;
                $orderdetail->discount_amount = session("discount_save");
                $orderdetail->save();
            }
            foreach ($cart as $cs) {
                DB::statement('UPDATE SHOES_SIZE S INNER JOIN CART C ON S.size_id = C.shoes_size_id SET s.quantity = s.quantity-c.quantity_cart WHERE SIZE_ID ='.$cs->shoes_size_id );
                DB::statement('DELETE FROM cart WHERE cart_id ='. $cs->cart_id);
                
            }
        return redirect()->action([CheckoutController::class, "Done"]);

        } else {
            //dùng thông tin mới
            $order = new Order();
            $order->customer_id = $id;
            $order->status = 1;
            $order->total_payment = session("total");
            $order->note = "Đặt Hàng ủng hộ Shopp!!!";
            $order->receiver_name = $request->fname;
            $order->receiver_tel = $request->phone;
            $order->receiver_add = $request->address;
            $order->save();


            foreach ($cart as $c) {
                $orderdetail = new OrderModel();
                $orderdetail->order_id = $order->id;
                $orderdetail->shoes_size_id = $c->shoes_size_id;
                $orderdetail->price = $c->price;
                $orderdetail->quantity = $c->quantity_cart;
                $orderdetail->discount_amount = session("discount_save");
                $orderdetail->save();
            }
            foreach ($cart as $cs) {
                DB::statement('DELETE FROM cart WHERE cart_id ='. $cs->cart_id);
                
            }
        return redirect()->action([CheckoutController::class, "Done"]);

        }
    }
    public function Done()
    {
      
        $count_cart = CartModel::where("customer_id", "=", request()->cookie("cusId"))->get();
        $count_cart = $count_cart->count();
        session()->put("countCart", $count_cart);
    
        return view("client.order_complete");
    }

    public function myOrder()
    {

        $order = Order::where("customer_id","=",request()->cookie('cusId'))->get();
        $sumOrder = $order->count();
        session()->put("sumOrder", $sumOrder);

        $orders = Order::join("orderdetail","order.id","=","orderdetail.order_id")->join("shoes_size","orderdetail.shoes_size_id","=","shoes_size.size_id")->join("shoes","shoes_size.shoes_id","=","shoes.id")->where("customer_id","=",request()->cookie('cusId'))->get();
        return view("client.my_order",compact('order',"orders"));
    }
    public function Order_status(Request $request,$id)
    {
        $order = Order::FindOrFail($id);
        if($request->status==='5'){
            $order->status = 5;
            $order->update();
            session()->flash("message","Hủy Đơn Hàng Thành Công");
        }
        if($request->status==='1'){
            $order->status = 1;
            $order->update();
            session()->flash("message","Mua lại đơn hàng thành công");

        }
        if($request->status==='2'){
            $order->status = 2;
            $order->update();
            session()->flash("message","Duyệt đơn hàng thành công");

        }
        if($request->status==='3'){
            $order->status = 3;
            $order->update();
            session()->flash("message","Đơn hàng đang vận chuyển");

        }
        if($request->status==='4'){
            $order->status = 4;
            $order->update();
            session()->flash("message","Đơn hàng đã hoàn thành");

        }
        return redirect()->back();
    }
}
