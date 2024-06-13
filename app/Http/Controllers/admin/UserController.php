<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.User.index');
    }

    public function save(Request $request)
    {
        $req = $request->all();
        $hidden_id = $req["hidden_id"];

        $rules = array(
            'name' => 'required',
            'email' => 'required|email|' . Rule::unique('users')->ignore($hidden_id), // make sure the email is an actual email
            'status' => 'required',
        );
        if ($hidden_id == '') {
            $rules['password'] = 'required|alphaNum|min:6';
        }

        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {

            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();
        } else {

            unset($req["_token"]);
            if ($req["password"] != '') {
                $req["password"] = Hash::make($req["password"]);
            } else {
                unset($req["password"]);
            }

            unset($req["hidden_id"]);
            if ($hidden_id == "") {
                $req["created_at"] = Carbon::now();
                if (User::insert($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Inserted Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = ["Error In Insert"];
                }
            } else {
                $req["updated_at"] = Carbon::now();
                if (DB::table('users')->where('id', $hidden_id)->update($req)) {
                    $response['status'] = 1;
                    $response['msg'] = " Updated Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = " Updated Successfully";
                }
            }
        }
        echo  json_encode($response);
        exit;
    }


    public function list(Request $request)
    {
        $_POST = $request->all();

        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value'];

        $users = DB::table('users');
        $total_record = $users->count();
        if ($searchValue != "") {

            $users->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('id', 'like', '%' . $searchValue . '%')
                ->orWhere('email', 'like', '%' . $searchValue . '%')
                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
        }
        $filtered_total_record = $users->count();

        $users->orderBy("$columnName", "$columnSortOrder",)->skip($row)->take($rowperpage);

        $data = $users->get()->toArray();

        foreach ($data as $key => $value) {
            $value->action = '<button type="button" data-id="' . $value->id . '"  class="edit_id btn btn-info">Edit</button>&nbsp;<button type="button" data-id="' . $value->id . '" class="delete_id  btn btn-danger">Delete</button>';
            if ($value->status == 1) {
                // rounded-lg text-light px-2 badge bg-success
                $value->status = " <span class='badge badge-pill badge-success'>Active</span> ";
            } else {
                $value->status = "<span class='badge-lg badge-pill badge-danger'>In Active</span>";
            }
            if ($value->created_at != "" && $value->created_at != null) {
                $value->created_at = Carbon::parse($value->created_at)->format('M d Y h:i A');
            }
        }

        $json_data = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($total_record),
            "recordsFiltered" => intval($filtered_total_record),
            "data"            => $data

        );

        echo json_encode($json_data);
        exit;
    }

    public function delete(Request $request)
    {

        $req = $request->all();
        unset($req["_token"]);


        $delete_query = DB::table('users')->where('id', $req["delete_id"])->delete();

        if ($delete_query) {
            $response['status'] = 1;
            $response['msg'] = "Data Is Successfully Deleted";
        } else {
            $response['status'] = 0;
            $response['msg'] = " Error In Delete";
        }
        echo json_encode($response);
        exit;
    }

    public function edit(Request $request)
    {
        $req = $request->all();
        unset($req["_token"]);

        $edit_query = DB::table('users')->where('id', $req["edit_id"])->first();

        if (isset($edit_query)) {
            $response['status'] = 1;
            $response['data'] = $edit_query;
        } else {
            $response['status'] = 0;
            $response['data'] = "Eroor In Data Edit";
        }
        echo json_encode($response);
        exit;
    }
}
