<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::select('id', 'name')->where('status', 1)->get()->toArray();
        $brands = Brand::select('id', 'name')->where('status', 1)->get()->toArray();
        return view('admin.Product.index')->with(compact('categories', 'brands'));
    }

    public function save(Request $request)
    {

        $req = $request->all();
         $hidden_id = $req["hidden_id"];

        $rules = array(
            'name' => 'required',
            'price' => 'required|integer|not_in:0|min:1',
            'quality' => 'required|integer|min:1',
            'category' => 'required',
            'brand' => 'required',
            'status' => 'required',
        );

        $validator = Validator::make($req, $rules);
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();
        } else {
            unset($req["_token"]);
           
            if ( $hidden_id  == "") {
                unset($req["hidden_id"]);
                $req["created_at"] = Carbon::now();
                if (Product::insert($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Inserted Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = "Error In Insert";
                }
            } else {

                unset($req["hidden_id"]);

                if (DB::table('products')->where('id',  $hidden_id )->update($req)) {
                    $response['status'] = 1;
                    $response['msg'] = "Updated Successfully";
                } else {
                    $response['status'] = 0;
                    $response['msg'] = "Error In Update";
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

        $product = DB::table('products')->select('products.*', 'categories.name as category_name', 'brands.name as brand_name')
            ->leftJoin('categories', 'categories.id', 'products.category')
            ->leftJoin('brands', 'brands.id', 'products.brand');

        $total_record = $product->count();
        if ($searchValue != "") {
            $product->where('products.name', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.id', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.description', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.price', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('categories.name', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('brands.name', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.quality', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.status', 'like', '%' . trim($searchValue) . '%')
                ->orWhere('products.created_at', 'like', '%' . trim($searchValue) . '%');
        }

        $filtered_total_record = $product->count();
        $product->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);
        $data = $product->get()->toArray();



        foreach ($data as $key => $value) {
            $value->action =  '<button type="button" style="Width:60%" data-id="' . $value->id . '"class="edit_id btn btn-info">Edit</button>&nbsp;
            <button type="button" style="Width:60%" data-id="' . $value->id . '" class="delete_id  btn btn-danger">Delete</button>&nbsp;
             <a style="Width:60%" class="btn btn-success" href="' .  route('admin.product.image.view', ['id' => $value->id]) . '">Image</a> ';
            if ($value->status == 1) {
                $value->status = "<span class='badge badge-pill badge-success'>Active</span>";
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
        $delete = DB::table("products")->where("id", $req['delete_id'])->delete();
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


    public function edit(Request $request)
    {
        $req = $request->all();

        unset($req["_token"]);

        $edit = DB::table('products')->where('id', $req['edit_id'])->first();
        if (isset($edit)) {
            $response['status'] = 1;
            $response['data'] = $edit;
        } else {
            $response['status'] = 0;
            $response['data'] = "Eroor In Edit";
        }
        echo json_encode($response);
        exit;
    }
}
