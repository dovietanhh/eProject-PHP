<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function showListCategory()
    {
        $category = CategoryModel::all();
        $pageTitle = "Danh sách Category";
        return view("admin.categories.category", compact("category", "pageTitle"));
    }
    public function editCategory(string $id)
    {
        $category = DB::table('category')->where("category_id", "=", $id)->select("*")->first();
        $des = html_entity_decode($category->description);
        $pageTitle = "Cập nhật Category";
        return view("admin.categories.editcategory", compact("category", "pageTitle", "des"));
    }
    public function updateCategory(string $id, Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $valid = $request->validate([
            "name" => "required",
            "description" => "required",
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000"
        ]);
        $cate = CategoryModel::find($id);
        $cate->category_name = $request->name;
        $cate->description = $request->description;
        if ($request->hasFile('avatar')) {

            $destination = "public/image" . $cate->avatar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $cate->avatar = $filename;
        }
        Session()->flash("success", "Cập nhật category thành công");

        $cate->save();
        return redirect()->action([CategoryController::class, "showListCategory"]);
    }
    public function addCategory()
    {
        $pageTitle = "Thêm Category";
        return view("admin.categories.addcategory")->with("pageTitle", $pageTitle);
    }
    public function saveCategory(Request $request)
    {
        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $valid = $request->validate([
            "name" => "required",
            "description" => "required",
            "avatar" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000"

        ]);
        $cate = new CategoryModel();
        $cate->category_name = $request->name;
        $cate->avatar = $request->avatar;
        $cate->description = $request->description;


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $cate->avatar = $filename;
        }
        $cate->save();
        Session()->flash("success", "Thêm category thành công");

        return redirect()->back();
    }

    public function deleteCategory(string $id)
    {
        $cate = new CategoryModel();
        $cate = $cate::findOrFail($id);
        $cate->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([CategoryController::class, "showListCategory"]);
    }
}
