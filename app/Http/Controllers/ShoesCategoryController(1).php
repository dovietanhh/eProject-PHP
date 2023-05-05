<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\CategoryModel;
use App\Models\ShoeSizeModel;
use Illuminate\Support\Facades\File;
use App\Models\ShoesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShoesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoes = DB::table('shoes')->select("category.*","shoes.*","brand.*")->join("category","shoes.category_id","=","category.category_id")
        ->join("brand","shoes.brand_id","=","brand.brand_id")->get();
        $pageTitle = "Danh sách giày";
        return view("admin.shoes.shoes", compact("shoes", "pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Thêm Giày Mới";
        $cate = CategoryModel::all();
        $brand = BrandModel::all();

        return view("admin.shoes.addShoes",compact("pageTitle","cate","brand"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên brand không được để trống",
        //     "description.required" => "Description không được để trống",
        //     "address.required" => "Địa chỉ không được để trống",
        //     "avatar.nullable" => "ảnh tải lên không được để trống",

        // ];
        $valid = $request->validate([
            "name" => "required",
            "description" => "required",
            // "avatar" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "price" => "required|numeric|gt:0",
            "gender" => "required",
            "brand" => 'required|not_in:0',
            "category" => 'required|not_in:0',

        ]);
        $shoes = new ShoesModel();
        $shoes->name = $request->name;
        $shoes->desc_shoes = $request->description;
        $shoes->price = $request->price;
        $shoes->avatar = $request->avatar;
        if($request->gender != ""&&strlen($request->gender)>0){
            $shoes->avatar = $request->avatar;
        }else{
            $shoes->avatar = "null";
        }
        $shoes->category_id = $request->category;
        $shoes->brand_id = $request->brand;


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $shoes->avatar = $filename;
        }

        $shoes->save();
        Session()->put("success", "Thêm giày mới thành công");

        return redirect()->action([ShoesCategoryController::class, "index"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shoes = ShoesModel::findOrFail($id);
        // $cate = DB::table("shoes")->select("category_id")->whereRaw("id = ".$id)->get();
        $cate = CategoryModel::all();
        $brand = BrandModel::all();

        $pageTitle = "Cập nhật Shoes";
        return view("admin.shoes.editShoes", compact("shoes", "pageTitle","cate","brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên brand không được để trống",
        //     "description.required" => "Description không được để trống",
        //     "address.required" => "Địa chỉ không được để trống",

        // ];
        $valid = $request->validate([
            "name" => "required",
            "description" => "required",
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "price" => "required|numeric|gt:0",

        ]);
        $shoes = ShoesModel::find($id);
        $shoes->name = $request->name;
        $shoes->desc_shoes = $request->description;
        $shoes->price = $request->price;
            $shoes->gender = $request->gender;
       
        $shoes->category_id = $request->category;
        $shoes->brand_id = $request->brand;

        if ($request->hasFile('avatar')) {

            $destination = "public/image" . $shoes->avatar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $shoes->avatar = $filename;
        }
        Session()->flash("success", "Cập nhật brand thành công");

        $shoes->save();
        return redirect()->action([ShoesCategoryController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $shoes = ShoesModel::findOrFail($id);
        $shoes->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([ShoesCategoryController::class, "index"]);

    }
    public function shoesSize()
    {
        $pageTitle = "Thêm size và số lượng giày";
        $size = ShoeSizeModel::join("shoes","shoes_size.shoes_id","=","shoes.id")->get();

        return view("admin.shoes.shoesSize",compact("pageTitle","size"));
    }
    public function createSizeShoes()
    {
        $pageTitle = "Thêm size và số lượng giày";
        $shoes = ShoesModel::all();
        return view("admin.shoes.addsizeshoes",compact("pageTitle","shoes"));
    }
    public function saveSizeShoes(Request $request)
    {
        $request->validate([
            "id" => "required",
            "size" => "required",
            "quantity" => "required|numeric|gt:0",

        ]);
        $size = new ShoeSizeModel();
        $size->shoes_id = $request->id;
        $size->size = $request->size;
        $size->quantity = $request->quantity;
        $size->save();
        return redirect()->action([ShoesCategoryController::class,"shoesSize"]);

    }
    public function editSizeShoes($id)
    {
        $pageTitle = "Cập nhật size và số lượng giày";
        $shoes = ShoesModel::all();
        $size = ShoeSizeModel::FindOrFail($id);
        return view("admin.shoes.editShoesSize",compact("pageTitle","shoes","size"));
    }
    public function updateSizeShoes($id,Request $r)
    {
        $size = ShoeSizeModel::FindOrFail($id);
        $size->shoes_id = $r->id;
        $size->size = $r->id;
        $size->quantity = $r->quantity;
        $size->update();
        Session()->flash("success", "Cập nhật thành công!!!");
        return redirect()->action([ShoesCategoryController::class,"shoesSize"]);
    }
}
