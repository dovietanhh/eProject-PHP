<?php

namespace App\Http\Controllers;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = EmployeeModel::join("role","employee.role_id","=","role.id")->get();
        $pageTitle = "Quản Lý Nhân Viên";
        
        return view("admin.employees.employees",compact("pageTitle","employees"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = "Thêm Nhân Viên";
        return view("admin.employees.addEmployees",compact("pageTitle"));
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
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $valid = $request->validate([
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "fullname"=>"required|string",
            "username"=>"required|string",
            "email"=>"required|email|unique:employee",
            'password' => [
                'required',
                'string',
                'min:10',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            "repassword"=>"required|same:password",
            "phone"=>["required","regex:/^(84|0[3|5|7|8|9])+([0-9]{8})$/"],//regex phone VN
            "dob"=>"required",
            "gen"=>"required|in:1,0"

        ]);
        $emp = new EmployeeModel();
        $emp->username = $request->username;
        $emp->avatar = $request->avatar;
        $emp->fullname = $request->fullname;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gen;
        $emp->password = md5($request->password);

        $emp->role_id = 0;
        $emp->dob = Carbon::parse($request->dob)->format("Y-m-d");




        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $emp->avatar = $filename;
        }
        $emp->save();
        Session()->flash("success", "Thêm nhân viên thành công");

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
        $employees = EmployeeModel::findOrFail($id);
        // $cate = DB::table("shoes")->select("category_id")->whereRaw("id = ".$id)->get();
  
        $date = Carbon::parse($employees->dob)->format('d-m-Y');
        $pageTitle = "Cập nhật Employee ". $employees->username;
        return view("admin.employees.editEmployees", compact("employees", "pageTitle","date"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $emp = EmployeeModel::findOrFail($id);

        echo "<pre>";
        print_r($request->all());
        echo "</pre>";
        // $mess = [
        //     "name.required" => "Tên category không được để trống",
        //     "description.required" => "Description không được để trống",
        // ];
        $valid = $request->validate([
            "avatar" => "nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            "fullname"=>"required|string",
            "username"=>"required|string",
            "email"=>"required|email|max:100|unique:employee,email",
           
            "phone"=>["required","regex:/^(84|0[3|5|7|8|9])+([0-9]{8})$/"],//regex phone VN
            "dob"=>"required",
            "gen"=>"required|in:1,0"

        ]);
        $emp->username = $request->username;
        $emp->fullname = $request->fullname;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->gender = $request->gen;
        $emp->dob = Carbon::parse($request->dob)->format("Y-m-d");
        $emp->password = md5($request->password);
        if ($request->hasFile('avatar')) {

            $destination = "public/image" . $emp->avatar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('public/image/', $filename);
            $emp->avatar = $filename;
        }
        Session()->flash("success", "Cập nhật nhân viên thành công");

        $emp->save();
        return redirect()->action([EmployeeController::class, "index"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $emp = EmployeeModel::find($id);
        $emp->delete();
        Session()->flash("success", "Dữ liệu được xóa thành công!!!");

        return redirect()->action([EmployeeController::class, "index"]);
    }
}
