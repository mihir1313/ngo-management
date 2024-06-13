<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use App\Models\Causes;
use App\Models\Contact;
use App\Models\Donations;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{

    private $stripe;
    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function index()
    {
        $volunteer = Volunteer::select('*')->where('status', 1)->count();

        return view('layouts.home.index')->with(compact('volunteer'));
    }

    public function about()
    {
        return view('layouts.about.about');
    }

    public function volunteer()
    {
        $volunteers = Volunteer::select('*')->where('status', 1)->get()->toArray();

        return view('layouts.volunteer.volunteer')->with(compact('volunteers'));
    }

    public function causes()
    {
        // $subquery = ;
    
        $causes = Causes::select('causes.*', 'sub.donation')
        ->leftJoinSub(DB::table('donations')
        ->select('cause_id', DB::raw('SUM(total) as donation'))
        ->groupBy('cause_id'), 'sub', function ($join) {
            $join->on('causes.id', '=', 'sub.cause_id');
        })
        ->get()->toArray();
    
  
        //  $donation = Donations::select('cause_id','total')->get()->toArray();


        return view('layouts.causes.causes')->with(compact('causes'));
    }

    public function contact()
    {
        return view('layouts.contact.contact');
    }

    public function contactSend(Request $request)
    {

        $post = $request->all();
        // echo '<pre>';
        // print_r($post);
        // die;
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
        );
  
        $validator = Validator::make($post, $rules);
        if ($validator->fails()) {
            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();
        }else{
            
            Mail::to($post['email'])->send(new MyTestMail($post['name']));

            $contact = new Contact();
            $contact['name'] = isset($post['name']) ? $post['name'] : '';
            $contact['email'] = isset($post['email']) ? $post['email'] : '';
            $contact['subject'] = isset($post['subject']) ? $post['subject'] : '';
            $contact['message'] = isset($post['message']) ? $post['message'] : '';
            $contact->save();

           return redirect()->route('contact')->withMessage('Profile saved!');

        }

    }


    public function donate(Request $request)
    {

        $data = $request->all();
    

        $response['status'] = 1;
        $rules = array(
            'nameoncard' => 'required|string',
            'cardnumber' => 'required|Integer|digits:16',
            'expirymonth' => 'Required|Integer|Between:1,12',
            'expiryyear' => 'required|Integer|Between:2023,2073',
            'securitycode' => 'required|min:3|max:3',
            'amount' => 'required|Integer',

        );

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {

            $response['status'] = 0;
            $response['msg'] = $validator->errors()->all();


            //  return Redirect::back()->withErrors($validator);
        } else {
            unset($data['_token']);

            $token = $this->createToken($request);

            if (!empty($token['error'])) {
                $response['status'] = 0;
                $response['msg'] = $token['error'];
            }
            if (empty($token['id']) && $response['status'] != 0) {
                $response['status'] = 0;
                $response['msg'] = 'Payment failed';
            }

            if ($response['status'] != 0) {

                // $charge = $this->createCharge($token['id'], $data['amount']);
                $charge = $this->createCharge($token['id'], $data['amount']);

                if (!empty($charge['error'])) {
                    $response['status'] = 0;
                    $response['msg'] = $charge['error'];
                }
                if (!empty($charge) && isset($charge['id']) && $charge['id'] != '' && $response['status'] != 0) {

                    $insertData = new Donations;
                    $insertData->cause_id = isset($data['causeId']) ? $data['causeId'] : '';
                    $insertData->transaction_id = isset($charge['id']) ? $charge['id'] : '';
                    $insertData->total = isset($data['amount']) ? $data['amount'] : '';
                    $insertData->transaction_status = isset($charge['status']) ? $charge['status'] : '';
                    $insertData->created_at = Carbon::now();
                    $insertData->save();

                    // $order =  DB::table('orders')->insertGetId(
                    //     array(
                    //         'user_id' => Auth::user()->id,
                    //         'created_at' =>  Carbon::now(),
                    //         'transaction_id' => $charge['id'],
                    //         'total' => $data['amount'],
                    //         'transaction_status' => $charge['status']
                    //     )
                    // );


                    if ($insertData->id) {

                        $response['status'] = 1;
                        $response['msg'] = "Donation Done Successfully";
                    } 
                    else {
                        $response['status'] = 0;
                        $response['msg'] = "Something Went Wrong!";
                    }
                } else if ($response['status'] != 0) {
                    $response['status'] = 0;
                    $response['msg'] = 'Payment failed.';
                }
            }
        }

        echo json_encode($response);
        exit;
    }
    private function createToken($data)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    // 'nameoncard' => $data['nameoncard'],
                    'number' => $data['cardnumber'],
                    'exp_month' => $data['expirymonth'],
                    'exp_year' => $data['expiryyear'],
                    'cvc' => $data['securitycode'],
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }

    private function createCharge($tokenId, $amount)
    {
        $charge = null;
        try {
            $charge = $this->stripe->charges->create([
                'amount' => ($amount * 100),
                'currency' => 'usd',
                'source' => $tokenId,
                'description' => 'My first payment'
            ]);
        } catch (Exception $e) {
            $charge['error'] = $e->getMessage();
        }
        return $charge;
    }
}
