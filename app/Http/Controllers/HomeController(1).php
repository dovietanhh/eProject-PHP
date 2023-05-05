<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use App\Models\CustomerModel;
use App\Models\ShoesImageModel;
use App\Models\ShoesModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class HomeController extends Controller
{
    public function index()
    {
            $shoes = ShoesModel::all();
            $count_cart = CartModel::where("customer_id", "=", request()->cookie("cusId"))->get();
            $count_cart = $count_cart->count();
            session()->put("countCart",$count_cart);
            return view("client.home", compact("shoes"));
  
        
        
    }
    public function ProductDetai(string $id)
    {
        $shoe_detail = ShoesModel::FindOrFail($id);
        $shoes = ShoesModel::all();
        $size = DB::table('shoes_size')->join("shoes", "shoes_size.shoes_id", '=', "shoes.id")->whereRaw("shoes_size.shoes_id=" . $id)->orderBy('size', 'asc')->get();
        $sizes = $size->count();
        $shoes_related = DB::table('shoes')->where("brand_id", "=", $shoe_detail->brand_id)->get();
        // ->OrWhere("category_id", "=", $shoe_detail->category_id)
        $shoesimg = DB::table('shoes_picture')->join("shoes", "shoes_picture.shoes_id", '=', "shoes.id")->whereRaw("shoes_picture.shoes_id=" . $id)->get();
        if ($shoesimg != null) {
            $shoesimgs = $shoesimg;
        } else {
            $shoesimgs = $shoe_detail->avatar;
        }
        // die($size);
        return view("client.product_detail", compact("shoe_detail", "shoes", "shoesimgs", "size", "shoes_related","sizes"));
    }
    public function search(Request $request)
    {
        $shoes = ShoesModel::where('name', 'LIKE', '%' . $request->search . '%')->get();

        if (!$shoes->isEmpty()) {
            session()->flash("info", $request->search);
            return view("client.home", compact("shoes"));
        } else {
            session()->flash("unsearch", "Không có sản phẩm này");
            session()->flash("info", $request->search);

            return redirect()->route("home");
        }
    }
    public function MenShoes()
    {
        $shoes = ShoesModel::where("gender","=","1")->get();
        return view("client.men", compact("shoes"));
    }
    public function WomenShoes()
    {
        $shoes = ShoesModel::where("gender","=","0")->get();
        return view("client.womenone", compact("shoes"));
    }

    public function Login(){
        session()->put("url_page",url()->previous());
        return view("client.login");
    }
    public function SignIn(Request $request){
        $username = $request->username;
        $pass = $request->password;

        
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $request->validate([
            "username" => 'required',
            'password' => [
                'required',
            ],

        ]);
        $customer = CustomerModel::where("username","=",$username)->where("password","=",$pass)->first();

        if($customer!==null){

            $minutes = 60;
            Cookie::queue("namecustomer",$username,$minutes);
            Cookie::queue("cusId",$customer->id,$minutes);
            if(session("url_page")==="http://127.0.0.1:8000/cart"){
            return redirect("http://127.0.0.1:8000/cart");

            }
            return redirect(session('url_page'));
        }else{
            return redirect()->action([HomeController::class,"login"]);
            
        }
    }
    public function logout(){
        Auth::logout();
        Cookie::queue(Cookie::forget("cusId"));
        Cookie::queue(Cookie::forget("namecustomer"));
        // Cookie::queue(Cookie::forget("countCart"));
        // session()->forget('url_page');
        // session()->forget('sumOrder');
session()->regenerate();
        return redirect()->action([HomeController::class,"index"]);

    }
}
