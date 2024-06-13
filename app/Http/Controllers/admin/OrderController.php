<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orders()
    {
        return view('admin.Orders.index');
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


        $order = DB::table('orders');

      
        $total_record = $order->count();

        if ($searchValue != "") {
            $order->where('id', 'like', '%' . $searchValue . '%')
                ->orWhere('user_id', 'like', '%' . $searchValue . '%')
                ->orWhere('transaction_id', 'like', '%' . $searchValue . '%')
                ->orWhere('subtotal', 'like', '%' . $searchValue . '%')
                ->orWhere('total', 'like', '%' . $searchValue . '%')
                ->orWhere('transaction_status', 'like', '%' . $searchValue . '%')
                ->orWhere('address', 'like', '%' . $searchValue . '%')
                ->orWhere('created_at', 'like', '%' . $searchValue . '%');
        }

        $filtered_total_record = $order->count();


        $order->orderBy($columnName,  $columnSortOrder)->skip($row)->take($rowperpage)->get();

        $data = $order->get()->toArray();


        foreach ($data as $key => $value) {
            $username = Order::select('orders.id', 'users.name')->leftJoin('users', 'users.id', 'orders.user_id')->where('user_id', $value->user_id)->get()->first();
            $value->user_id = $username['name'];
            if ($value->created_at != "" && $value->created_at != null) {
                $value->created_at = Carbon::parse($value->created_at)->format('M d Y h:i A');
            }
            $value->action = ' <a  class="btn btn-success" href="' .  route('admin.orders.items', ['id' => $value->id]) . '">View Items</a> ';
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
}
