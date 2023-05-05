<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::join("customer","order.customer_id","=","customer.id")->get(["customer.fullname","Customer.gender","customer.phone","customer.username","customer.email","order.id","order.status"]);
        $orders = Order::all();

        $pageTitle = "Quản Lý Order";
       

        return view("admin.orderdetails.order",compact("pageTitle","order","orders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
   
    public function show(string $id)
    {
        $pageTitle = "Quản Lý Order Detail";
        session()->put("orderdetail_id",$id);
        $order_status = Order::join("orderstatus","order.status","=","orderstatus.status_id")->whereRaw("order.id=".$id)->first();
        $order = OrderModel::join("shoes_size","orderdetail.shoes_size_id","=","shoes_size.size_id")->join("shoes","shoes_size.shoes_id","=","shoes.id")->whereRaw("order_id=".$id)->get();
       return view("admin.orderdetails.order_details",compact("pageTitle","order","order_status"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $or = OrderModel::find($id);
        $or->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([CustomerController::class, "index"]);
    }
}
