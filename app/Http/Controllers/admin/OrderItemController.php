<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{

    public function orders_items($id)
    {
        return view('admin.Orderitems.index')->with(compact('id'));
    }
    public function orders_list(Request $request)
    {

        $_POST = $request->all();
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value'];
        $order_id = $request->order_id;


        $orderitems = DB::table('order_items');

        $orderitems->where('order_id', '=', $order_id);

        $total_record = $orderitems->count();

        if ($searchValue != "") {
            $orderitems->where(function ($query) use ($searchValue) {
                $query->where('product_name', 'like', '%' . $searchValue . '%')
                    ->orWhere('product_price', 'like', '%' . $searchValue . '%')
                    ->orWhere('quantity', 'like', '%' . $searchValue . '%')
                    ->orWhere('total_price', 'like', '%' . $searchValue . '%')
                    ->orWhere('created_at', 'like', '%' . $searchValue . '%');
            });
        }




        $filtered_total_record = $orderitems->count();

        $orderitems->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);


        // $data = $orderitems->toSql();
        // echo '<pre>';
        // print_r($data);
        // die;
        $data = $orderitems->get()->toArray();

        foreach ($data  as $key => $value) {
            $product_img = json_decode($value->product_data);

            $value->product_data = '<img src="' . asset('uploads/product') . '/' . $product_img->img . '"  width="100" height="100"> ';
        }

        $json_data = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($total_record),
            "recordsFiltered" => intval($filtered_total_record),
            "data"            => $data
        );

        echo  json_encode($json_data);
        exit;
    }
}
