<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportAdminController extends Controller
{
    /**
	 * Reports main page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('admin.report.index');
	}
}
