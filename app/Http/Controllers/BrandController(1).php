<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
        $brand = BrandModel::all();
        $pageTitle = "Danh sách Brand";
        return view("admin.brands.brand", compact("brand", "pageTitle"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Thêm Brand";
        return view("admin.brands.addbrand")->with("pageTitle", $pageTitle);
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
            "address" => "required",
            "avatar" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048"


        ]);
        $brand = new BrandModel();
        $brand->brand_name = $request->name;
        $brand->b_avatar = $request->avatar;
        $brand->description = $request->description;
        $brand->address = $request->address;



        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $brand->b_avatar = $filename;
        }
        $brand->save();
        Session()->flash("success", "Thêm brand thành công");

        return redirect()->back();
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
        $brand = BrandModel::findOrFail($id);
        // $brand = DB::table("brand")->select("*")->whereRaw("brand_id = ".$id)->first();
        $pageTitle = "Cập nhật Category";
        return view("admin.brands.editbrand", compact("brand", "pageTitle"));
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
            "address" => "required",
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000"
        ]);
        $brand = BrandModel::find($id);
        $brand->brand_name = $request->name;
        $brand->description = $request->description;
        $brand->address = $request->address;

        if ($request->hasFile('avatar')) {

            $destination = "public/image" . $brand->avatar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $brand->b_avatar = $filename;
        }
        Session()->flash("success", "Cập nhật brand thành công");

        $brand->save();
        return redirect()->action([BrandController::class, "index"]);
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = DB::table("brand")->whereRaw("brand_id = ".$id);
        $brand->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([BrandController::class, "index"]);

    }
}
