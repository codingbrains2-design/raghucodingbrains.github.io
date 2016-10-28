<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoginController extends Controller
{

	public function getAdminLogin()
	{
		return view('admin.login');
	}

	public function adminLogin(Request $request){
		$validator = \Validator::make(
			array(
				'email' =>$request->email,
				'password' =>$request->password
				),
			array(
				'email' =>'required|email',
				'password' =>'required|alpha_num|min:5'
				)
			);
		if($validator->fails())
		{
			return redirect('/admin')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$user= array('email'=>$request->email,'password'=>$request->password);
			if(\Auth::attempt($user)){
				return redirect('/admin/dashboard');
			}
			else{
				return redirect('/admin')->with('login_error',"Invalid email or password");
			}
		}

	}

	public function getLogin()
	{
		return view('employee.login');
	}

	public function login(Request $request){
		$validator = \Validator::make(
			array(
				'email' =>$request->email,
				'password' =>$request->password
				),
			array(
				'email' =>'required|email',
				'password' =>'required|alpha_num|min:5'
				)
			);
		if($validator->fails())
		{
			return redirect('/login')
			->withErrors($validator)
			->withInput();
		}
		else
		{
			$user= array('email'=>$request->email,'password'=>$request->password);
			if(\Auth::attempt($user)){
				return redirect('/user/dashboard');
			}
			else{
				return redirect('/login')->with('login_error',"Invalid email or password");
			}
		}

	}
	public function getSignOut() {

		\Auth::logout();
		return redirect('/login');

	}
}
