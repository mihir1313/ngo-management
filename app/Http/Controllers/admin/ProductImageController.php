<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductImageController extends Controller
{
    public function index($id)
    {
        return view('admin.ProductImage.index')->with(compact('id'));
    }


    public function save(Request $request)
    {

        $files = $request->file;


        $req['product_id'] = $request["product_id"];
        $req['created_at'] = Carbon::now();
        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $name = rand(1, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/product'), $name);
                $req["img"] = $name;


                ProductImage::insert($req);
            }
        }
        exit;
    }

    public function list(Request $request)
    {
        $_POST = $request->all();
        $draw = $_POST["draw"];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value'];

        $product_image = DB::table('product_image')->where("product_id", $_POST['product_id']);
        $total_record = $product_image->count();
      

        if ($searchValue != "") {
            $product_image->where(function ($query) use ($searchValue) {
                $query->where('id', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('created_at', 'like', '%' . trim($searchValue) . '%');
            });
        }
        $filtered_total_record = $product_image->count();
        $product_image->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);
        $data = $product_image->get()->toArray();

        foreach ($data as $key => $value) {
            $value->img = '<img src="' . asset('uploads/product/') . '/' . $value->img . '" alt="Girl in a jacket" width="100">';

            $value->action = '<button type="button" data-id="' . $value->id . '"  class="delete_id btn btn-danger">Delete</button>';

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

        $delete = DB::table('product_image')->where("id", $req['delete_id'])->delete();

        if ($delete) {
            $response['status'] = 1;
            $response['msg'] = "Deleted Successfully";
        } else {
            $response['status'] = 0;
            $response['msg'] = "Error In Delete";
        }
        echo json_encode($response);
        exit;
    }
}
