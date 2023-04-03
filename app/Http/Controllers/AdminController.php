<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.index")->with("pageTitle", "Trang chủ Admin");
    }
    //ham cap nhat role
    public function updateRole($id, Request $request)
    {
        $employee = EmployeeModel::findOrFail($id);
        if ($request->role == 1) {
            Session()->flash("success", "Update Role Employee ".$employee->fullname." is nhan vien quan ly");

            $employee->role_id = 0;
        } else {
            $employee->role_id = 1;
            Session()->flash("success", "Update Role Employee ".$employee->fullname." is Quan tri tat ca");
        }
        $employee->update();
        return redirect()->action([EmployeeController::class, "index"]);
    }
}
