<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CartModel;
use App\Models\ShoeSizeModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon as SupportCarbon;
use Illuminate\Support\Facades\Redis;
use Ramsey\Uuid\Type\Integer;

class Cart extends Controller
{
    //
    public static function countCart()
    {
        $count_cart = CartModel::where("customer_id", "=", request()->cookie("cusId"))->get();
        $count_cart = $count_cart->count();
        session()->put("countCart", $count_cart);
    }
    public function index(Request $request)
    {
        session()->put("url_page","http://127.0.0.1:8000/cart");
        $this->countCart();
        if (request()->cookie("namecustomer") !== null && request()->cookie("namecustomer") !== "") {
            $cart = DB::table("cart")->join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->join("shoes", "shoes_size.shoes_id", "=", "shoes.id")->where("customer_id", "=", request()->cookie("cusId"))->get();
            $subtotal = DB::table("cart")->join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->join("shoes", "shoes_size.shoes_id", "=", "shoes.id")->whereRaw("customer_id =" . request()->cookie("cusId"))->get();
            $sub = 0;
            foreach ($subtotal as $row) {
                $sub += $row->quantity_cart * $row->price;
            }
            // dd($sub);
            // <!-- SELECT SUM(cart.quantity_cart*shoes.price) FROM `cart` JOIN shoes_size On cart.shoes_size_id = shoes_size.size_id JOIN shoes ON shoes_size.shoes_id = shoes.id where customer_id=1; -->
            // dd();

            //  dd(session("cart"));


            // 
            return view("client.cart")->with("cart", $cart)->with("subtotal", $sub);
        }
        return redirect()->action([HomeController::class, "login"]);
    }
    public function addCart(Request $request)
    {


        echo "<pre>";
        print_r($request->all());
        echo "</pre>";

        $id = (int)($request->size_id);

        if (request()->cookie("namecustomer") !== null && request()->cookie("namecustomer") !== "") {
            $mess = [

                "size_id.not_in" => "ban phai chon size",
                "quantity.required" => "So luong khong duoc de trong",
                "quantity.numeric" => "So luong phai la so",
                "quantity.min" => "So luong them vao gio hang it nhat 1 san pham",



            ];
            $request->validate([
                "size_id" => "not_in:0",
                "quantity" => "required|numeric|min:1",
            ], $mess);
            $cart_update = CartModel::join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->join("shoes", "shoes_size.shoes_id", "=", "shoes.id")->where("size_id", "=", $id)->where("customer_id", "=", request()->cookie("cusId"))->first();
            $this->countCart();
            // dd($cart_update);
            if ($cart_update !== null) {
                // dd($cart_update->quantity_cart + $request->quantity);
                if ($cart_update->quantity_cart + $request->quantity > $cart_update->quantity) {
                    session()->flash("err", "So luong them vao qua lon");
                    return redirect()->back();
                } else {

                    $cart_update->quantity_cart = $cart_update->quantity_cart + $request->quantity;
                    $cart_update->update();
                    session()->flash("success", "Them san pham vao gio hang thanh cong");
                    return redirect()->back();
                }
            } else {
                $cart_add = ShoeSizeModel::where("size_id", "=", $id)->where("size_id", "=", $id)->first();
                if ($request->quantity > $cart_add->quantity) {
                    session()->flash("err", "So luong them vao qua lon");
                    return redirect()->back();
                } else {
                    $cart = new CartModel();
                    $cart->customer_id = $request->cookie("cusId");
                    $cart->shoes_size_id = $request->size_id;
                    $cart->quantity_cart = $request->quantity;
                    $cart->save();
                    session()->flash("success", "Them san pham vao gio hang thanh cong");
                }
            }

            return redirect()->back();
        }
        return redirect()->action([HomeController::class, "login"]);
    }
    public function DeleteCart(string $id)
    {

        if ($id !== null || $id !== "") {
            $cart = CartModel::FindOrFail($id);
            $cart->delete();
            Session()->flash("success", "Dữ liệu được xóa thành công!!!");
        }

        return redirect()->back();
    }
    public function UpdateCart(string $id, Request $request)
    {
        $cart = CartModel::FindOrFail($id);
        $shoes_size = CartModel::join("shoes_size", "cart.shoes_size_id", "=", "shoes_size.size_id")->where("shoes_size_id", "=", $cart->shoes_size_id)->first();
        if ($id !== null || $id !== "") {


            if ($cart !== null) {
                if ($request->quantity > $shoes_size->quantity) {
                    Session()->flash("err", "So luong order vuot qua Hang Ton Kho!!!");
                    return redirect()->back();
                }
                $cart->quantity_cart = $request->quantity;
                $cart->update();
                Session()->flash("success", "Dữ liệu được cập nhật thành công!!!");
            }
        }
        // $shoes_size = DB::statement("update shoes_size s INNER JOIN cart c on s.size_id=c.shoes_size_id SET s.quantity=s.quantity-c.quantity_cart where s.size_id =".$cart_item->shoes_size_id." and c.customer_id=".request()->cookie("cusId"));
        return redirect()->back();
    }
    public function discount_rate(Request $request)
    {

        $mytime = new DateTime("now");
        $mytime = $mytime->format('Y-m-d');

        $discount = DB::table("discount")->whereRaw("id =" . $request->discount)->whereDate("fromdate", "<=", $mytime)->whereDate("todate", ">=", $mytime)->first();
        if ($discount !== null) {
            $data = $discount->discount_rate;
            session()->flash("data", $data);
            session()->flash("IdSale", $request->discount);

            session()->flash("messageSuccess", "Ma Giam Gia dc ap dung cho ngay " . $discount->description);

            return redirect()->back();
        } else {
            session()->flash("data", null);
            session()->flash("messageErr", "Ma Giam Gia da het han hoac sai ma");

            return redirect()->back();
        }
    }
}

// update shoes_size s INNER JOIN cart c on s.size_id=c.shoes_size_id SET s.quantity=s.quantity-c.quantity_cart where s.size_id=9 and c.customer_id=1;