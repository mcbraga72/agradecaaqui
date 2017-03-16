<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
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
		return view('admin.report.index');
	}

    /**
	 * Generate reoports
	 *
	 * @return Response
	 */
	public function generateReport()
	{
		$report = User::select('state', \DB::raw("count(users.state) as thanks"))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.state')->get();
		return $report;
	}
}
