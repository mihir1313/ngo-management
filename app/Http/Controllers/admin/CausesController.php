<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Causes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CausesController extends Controller
{
    public function index()
    {
        return view('admin.Causes.index');
    }

    public function save(Request $request)
    {
       $post = $request->all();

       $response = array();
       $response['status'] = 0;
       $response['msg'] = "Something went wrong please try again.";

       $hidden_id = $post['hidden_id'];
       $rules = array(
           'title' => 'required',
           'target' => 'required',
           'description' => 'required',
       );

       $validator = Validator::make($post, $rules);
       if ($validator->fails()) {
           $response['status'] = 0;
           $response['msg'] = $validator->errors()->all();
       } else {

           
           if(isset($hidden_id) && $hidden_id != ''){

           $updateData = Causes::select('*')->where('id',$hidden_id)->first();
               
           if(isset($post['image'])){
            $name = time() . '.' . $post["image"]->getClientOriginalExtension();
            $post["image"]->move(public_path('uploads/causes'), $name);
            $updateData->img = $name;
            }
            $updateData->title = isset($post['title']) ? $post['title'] : '';
            $updateData->target = isset($post['target']) ? $post['target'] : '';
            $updateData->description = isset($post['description']) ? $post['description'] : '';
            $updateData->updated_at = Carbon::now();
            $updateData->save();

            if($updateData->id){
                $response['status'] = 1;
                $response['msg'] = 'Causes Updated SuccessFully.';
               }

        }else{
           $insertData = new Causes;

           $insertData->title = isset($post['title']) ? $post['title'] : '';

           if (isset($post['image']) && $post['image'] != "") {
            $name = time() . '.' . $post["image"]->getClientOriginalExtension();
            $post["image"]->move(public_path('uploads/causes'), $name);
            $insertData->img = $name;
        }
           $insertData->target = isset($post['target']) ? $post['target'] : '';
           $insertData->description = isset($post['description']) ? $post['description'] : '';
           $insertData->created_at = Carbon::now();
           $insertData->save();

           if($insertData->id){
            $response['status'] = 1;
            $response['msg'] = 'Causes added SuccessFully.';
           }
        }
       }
       echo json_encode($response);
       exit;
    }

    public function causesList(Request $request)
    {
        
        $_POST = $request->all();
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value'];

        $causes = Causes::select('causes.*', 'sub.donation')
        ->leftJoinSub(DB::table('donations')
        ->select('cause_id', DB::raw('SUM(total) as donation'))
        ->groupBy('cause_id'), 'sub', function ($join) {
            $join->on('causes.id', '=', 'sub.cause_id');
        });

        $total_record = $causes->count();
        if ($searchValue != "") {

            $causes->where('causes.title', 'like', '%' . $searchValue . '%')
                ->orWhere('causes.id', 'like', '%' . $searchValue . '%')
                ->orWhere('causes.created_at', 'like', '%' . $searchValue . '%');
        }
        $filtered_total_record = $causes->count();

        $causes->orderBy($columnName, $columnSortOrder)->skip($row)->take($rowperpage);
        $data = $causes->get()->toArray();
        $arr = array();

        foreach ($data as $key => $value) {
         
            $value['img'] = '<img src="' . asset('uploads/causes/') . '/' . $value['img'] . '" alt="Girl in a jacket" width="100">';

            $value['action'] = '<button id="editId" type="button" data-id="' .$value['id'] . '"  class="edit_id btn btn-info">Edit</button>&nbsp;<button type="button" id="deleteId" data-id="' .  $value['id'] . '" class="delete_id  btn btn-danger">Delete</button>';
            if ($value['created_at'] != "" && $value['created_at'] != null) {
                $value['created_at'] = Carbon::parse($value['created_at'])->format('M d Y h:i A');
            }
            array_push($arr,$value);
        }
        $json_data = array(
            "draw"            => intval($draw),
            "recordsTotal"    => intval($total_record),
            "recordsFiltered" => intval($filtered_total_record),
            "data"            => $arr

        );

        echo json_encode($json_data);
        exit;
    }


    public function delete(Request $request)
    {
       $post = $request->all();
       $id = $post['id'];

       $response = array();
       $response['status'] = 0;
       $response['msg'] = "Something went wrong please try again.";


       if(isset($id) && $id != ''){
        Causes::where('id',$id)->delete();
        $response['status'] = 1;
        $response['msg'] = "Data deleted successfully";
       }else{
        $response['status'] = 0;
        $response['msg'] = "Error In Deleting";
       }
       echo json_encode($response);
       exit();
    }

    public function edit(Request $request)
    {
        $post = $request->all();

        $id = $post['id'];

        $response = array();
        $response['status'] = 0;
        $response['msg'] = "Something went wrong please try again.";

   if(isset($id) && $id != ""){
    $data = Causes::select('*')->where('id',$id)->first();

    if(!empty($data)){
        $response['status'] = 1;
        $response['msg'] = "Data found successfully";
        $response['data'] = $data;

    }else{
        $response['status'] = 0;
        $response['msg'] = "Something went wrong please try again.";
    }
   }

   echo json_encode($response);
   exit;
    }
}
