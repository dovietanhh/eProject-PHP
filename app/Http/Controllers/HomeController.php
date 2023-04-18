<?php

namespace App\Http\Controllers;

use App\Models\ShoesModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $shoes = ShoesModel::all();
        return view("client.home",compact("shoes"));
    }
    public function ProductDetai(string $id)
    {
       $shoe_detail = ShoesModel::FindOrFail($id);
       $shoes= ShoesModel::all();

       return view("client.product_detail",compact("shoe_detail","shoes"));
    }
}
