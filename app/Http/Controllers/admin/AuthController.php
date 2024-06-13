<?php

namespace App\Http\Controllers\admin;

use Redirect;
use Auth;
use Input;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{


  function login()
  {
    return view('admin.Auth.login');
  }

  function dologin(Request $request)
  {
    $requestAry = $request->all();
    $rules = array(
      'email' => 'required|email',
      'password' => 'required|alphaNum|min:8'
    );
    $validator = Validator::make($requestAry, $rules);

    if ($validator->fails()) {
      return Redirect::to('admin/login')->withErrors($validator);
    } else {
      $userdata = array(
        'email' => $requestAry['email'],
        'password' => $requestAry['password']
      );
      // attempt to do the login
      if (Auth::guard('admin')->attempt($userdata)) {
        return Redirect::to('admin/dashboard')->withSuccess(['login successfully']);
      } else {
        return Redirect::to('admin/login')->withErrors(["login credentials is wrong"]);
      }
    }
  }

  function logout(Request $request)
  {
    Auth::guard('admin')->logout();
    // $request->session()->invalidate();
    return redirect('admin/login');
  }
}
