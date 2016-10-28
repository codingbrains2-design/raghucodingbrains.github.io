<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmployeeController extends Controller
{
	public function home()
	{
		return view('employee.home');
	}
	public function apply_leave()
	{
		return view('employee.apply_leave');
	}

	public function post_apply_leave()
	{

	}

	public function my_leave()
	{
		return view('employee.apply_leave');
	}
	public function leave_report()
	{
		return view('employee.leave_report');
	}
	public function leave_calender()
	{
		return view('employee.leave_calender');
	}
}
