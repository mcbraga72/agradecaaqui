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
		return view('enterprise.report.index');
	}

    /**
	 * Generate reports by state
	 *
	 * @return Response
	 */
	public function generateStateReport()
	{
		$stateReport = User::select('state', \DB::raw("count(users.state) as thanks"))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.state')->get();
		
		return $stateReport;
	}

	/**
	 * Generate reports by city
	 *
	 * @return Response
	 */
	public function generateCityReport()
	{
		$cityReport = User::select('city', \DB::raw("count(users.city) as thanks"))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.city')->get();
		
		return $cityReport;
	}

	/**
	 * Generate reports by gender
	 *
	 * @return Response
	 */
	public function generateGenderReport()
	{
		$genderReport = User::select('gender', \DB::raw("count(users.gender) as thanks"))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.gender')->get();
		
		return $genderReport;
	}

	/**
	 * Generate a custom report
	 *
	 * @return Response
	 */
	public function generateCustomReport($type, $start='2017-06-01', $end='2017-07-10')
	{		
		$customReport = User::select('users.' . $type, \DB::raw("count(users.gender) as thanks"))->whereBetween('thanksDateTime', array('2017-06-01', '2017-07-10'))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.' . $type)->toSql();
		
		dd($customReport);
		return response()->json($customReport);		
	}
}
