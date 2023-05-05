<?php

namespace App\Http\Controllers;

use App\Models\ShoesImageModel;
use App\Models\ShoesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ShoesImagesController extends Controller
{
    public function index()
    {
      
        $shoespic = ShoesImageModel::join("shoes","shoes_picture.shoes_id","=","shoes.id")->get();
        $pageTitle = "Ảnh sản phẩm";
        return view("admin.shoes.shoespic", compact("shoespic", "pageTitle"));
    }
    public function create(String $id)
    {   
        $shoespic = ShoesModel::FindOrFail($id);
        $pageTitle = "Thêm ảnh sản phẩm";
        return view("admin.shoes.addshoespic", compact("shoespic", "pageTitle"));
    }
    public function createOne()
    {   
        
        $pageTitle = "Thêm ảnh sản phẩm";
        $shoes = ShoesModel::all();

        return view("admin.shoes.addshoespicOne", compact("pageTitle","shoes"));
    }
    public function SaveImage(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $request->validate([
            // "avatar" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);
        $shoespic = new ShoesImageModel();
        $shoespic->shoes_id = $request->id;
        $shoespic->picture = $request->avatar;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $shoespic->picture = $filename;
        }
        $shoespic->save();
        Session()->flash("success", "Thêm ảnh mới thành công");

        return redirect()->action([ShoesImagesController::class,"index"]);
        
    }
    public function edit(string $id)
    {
        $shoespic = ShoesImageModel::findOrFail($id);
        // $cate = DB::table("shoes")->select("category_id")->whereRaw("id = ".$id)->get();
        $shoes = ShoesModel::find($shoespic->shoes_id);
        $pageTitle = "Cập nhật Ảnh ". $shoes->name;
        return view("admin.shoes.editshoespic", compact("shoespic", "pageTitle","shoes"));
    }
    public function update(Request $request,$id)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $request->validate([
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
        ]);
        $shoespic = ShoesImageModel::FindOrFail($id);

        if ($request->hasFile('avatar')) {

            $destination = "public/image" . $shoespic->avatar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $shoespic->picture = $filename;
        }
        $shoespic->update();
        Session()->flash("success", "Cập nhật thành công");

        return redirect()->action([ShoesImagesController::class,"index"]);
        
    }
    public function destroy(string $id)
    {
        $shoespic = ShoesImageModel::find($id);
        $shoespic->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([ShoesImagesController::class, "index"]);
    }
}
