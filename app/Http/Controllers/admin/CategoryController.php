<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {

        return view('admin.Category.index');
    }



    public function save(Request $request)
    {

        $req = $request->all();
        $hidden_id = $req['hidden_id'];
        $rules = array(
            'name' => 'required',
            'status' => 'required',
        );
        if ($hidden_id == "") {

            $rules['image']  = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        }
        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();
        } else {

            if (isset($req['image']) && $req['image'] != "") {
                $name = time() . '.' . $req["image"]->getClientOriginalExtension();
                $req["image"]->move(public_path('uploads/category'), $name);
                $req["img"] = $name;
            }

            unset($req["_token"]);
            unset($req["hidden_id"]);
            unset($req["image"]);
            if ($hidden_id == "") {
                $req['created_at'] = Carbon::now();
                if (Category::insert($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Inserted Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = "Error  In Insert ";
                }
            } else {
                $req['created_at'] = Carbon::now();
                if (DB::table('categories')->where('id', $hidden_id)->update($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Updated Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = "Eroor In Update";
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

        $categories = DB::table('categories');

        $total_record = $categories->count();
        if ($searchValue != "") {

            $categories->where('name', 'like', '%' . $searchValue . '%')
                ->orWhere('id', 'like', '%' . $searchValue . '%')
                ->orWhere('status', 'like', '%' . $searchValue . '%')
                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
        }
        $filtered_total_record = $categories->count();

        $categories->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);
        $data = $categories->get()->toArray();

        foreach ($data as $key => $value) {
            $value->img = '<img src="' . asset('uploads/category/') . '/' . $value->img . '" alt="Girl in a jacket" width="100">';

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


        if (DB::table('categories')->where('id', $req['delete_id'])->delete()) {
            $response['status'] = 1;
            $response['msg'] = "Deleted Successfully";
        } else {
            $response['status'] = 0;
            $response['msg'] = "Error  In Deleted";
        }

        echo json_encode($response);
        exit();
    }


    public function edit(Request $request)
    {
        $req = $request->all();
        unset($req["_token"]);

        $categories = DB::table('categories')->where('id', $req['edit_id'])->first();

        if (isset($categories)) {
            $response['status'] = 1;
            $response['data'] = $categories;
        } else {
            $response['status'] = 1;
            $response['data'] = "Error In Edit";
        }

        echo json_encode($response);
        exit;
    }
}
