<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminController extends Controller
{
	public function home()
	{
		return view('admin.dashboard');
	}
	public function systemUsers()
	{
		return view('admin.systemUser');
	}
	public function add_user()
	{
		return view('admin.add_user');
	}
	public function user_roles()
	{
		return view('admin.user_role');
	}
}
