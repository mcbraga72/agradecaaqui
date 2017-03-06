<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportEnterpriseController extends Controller
{
    /**
	 * Reports main page
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('enterprise.report.index');
	}
}
