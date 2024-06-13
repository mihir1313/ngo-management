<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandControlle extends Controller
{
    public function index()
    {
        return view('admin.Brand.index');
    }


    public function save(Request $request)
    {
        $req = $request->all();
        $hidden_id = $req['hidden_id'];
        $rules = array(
            'name' => 'required',
            'status' => 'required',
        );

        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();
        } else {
            unset($req["_token"]);
            unset($req["hidden_id"]);

            if ($hidden_id == "") {
                $req['created_at'] = Carbon::now();
                if (Brand::insert($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Inserted Successfully ";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = "Error In Insert";
                }
            } else {
                $req['created_at'] = Carbon::now();
                if (DB::table('brands')->where('id', $hidden_id)->update($req)) {
                    $response["status"] = 1;
                    $response['msg'] = "Updated  Successfully";
                } else {
                    $response["status"] = 0;
                    $response["msg"] = "Error In Update";
                }
            }
        }

        echo json_encode($response);
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

        $brand = DB::table('brands');
        $total_record = $brand->count();

        if ($searchValue != "") {
            $brand->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('id', 'like', '%' . $searchValue . '%')
                ->orWhere('status', 'like', '%' . $searchValue . '%')
                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
        }

        $filtered_total_record = $brand->count();
        $brand->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);
        $data = $brand->get()->toArray();


        foreach ($data as $key => $value) {
            $value->action = '<button type="button" data-id="' . $value->id . '"  class="edit_id btn btn-info">Edit</button>&nbsp;<button type="button" data-id="' . $value->id . '" class="delete_id  btn btn-danger">Delete</button>';

            if ($value->status == 1) {
                $value->status = "<span class='badge badge-pill badge-success'>Active</span> ";
            } else {
                $value->status = "<span class='badge-lg badge-pill badge-danger'>In Active</span>";
            }
            if ($value->created_at != null && $value->created_at != "") {

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

        $brand = DB::table('brands')->where('id', $req["delete_id"])->delete();

        if (isset($brand)) {
            $response["status"] = 1;
            $response["msg"] = "Deleted Successfully";
        } else {
            $response["status"] = 0;
            $response["msg"] = "Error In Delete";
        }
        echo json_encode($response);
        exit;
    }

    public function edit(Request $request)
    {
        $req = $request->all();
        unset($req["_token"]);

        $brand = DB::table('brands')->where('id', $req["edit_id"])->first();


        if (isset($brand)) {
            $response['status'] = 1;
            $response['data'] = $brand;
        } else {
            $response['status'] = 0;
            $response['data'] = "Error In Edit";
        }

        echo json_encode($response);
        exit;
    }
}
