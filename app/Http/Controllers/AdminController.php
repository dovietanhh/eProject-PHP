<?php

namespace App\Http\Controllers;

use App\Models\EmployeeModel;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function Beforelogin()
    {
        return view("admin.login");
    }
    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $emp = DB::table('employee')->where("email", $email)->where("password", $password)->first();
        if ($emp !=null) {
            $minutes = 60;
            Cookie::queue("name", $emp->username, $minutes);
            Cookie::queue("id", $emp->emp_id, $minutes);
            


            return view("admin.index")->with("pageTitle", "Trang chủ Admin");

        }
        return redirect()->action([AdminController::class, "Beforelogin"]);
    }
    public function index(Request $request)
    {
        if ($request->cookie('id')) {
            return view("admin.index")->with("pageTitle", "Trang chủ Admin");
        }
        return redirect()->action([AdminController::class, "Beforelogin"]);
    }
    //ham cap nhat role
    public function updateRole($id, Request $request)
    {
        $employee = EmployeeModel::findOrFail($id);
        if ($request->role == 1) {
            Session()->flash("success", "Update Role Employee " . $employee->fullname . " is nhan vien quan ly");

            $employee->role_id = 0;
        } else {
            $employee->role_id = 1;
            Session()->flash("success", "Update Role Employee " . $employee->fullname . " is Quan tri tat ca");
        }
        $employee->update();
        return redirect()->action([EmployeeController::class, "index"]);
    }
    public function logoutAdmin()
    {
       Auth::logout();
       Cookie::queue(Cookie::forget("id"));

       return redirect()->action([AdminController::class, "Beforelogin"]);

    }
}
