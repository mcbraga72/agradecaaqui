<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Carbon\Carbon;
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

	/**
	 * Generate reports by city
	 *
	 * @return Response
	 */
	public function generateCityReport($start, $end)
	{
		$cityReport = User::select('city', \DB::raw("count(users.city) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.city')->get();
		
		return $cityReport;
	}

    /**
	 * Generate reports by state
	 *
	 * @return Response
	 */
	public function generateStateReport($start, $end)
	{
		$stateReport = User::select('state', \DB::raw("count(users.state) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.state')->get();
		
		return $stateReport;
	}

	/**
	 * Generate reports by gender
	 *
	 * @return Response
	 */
	public function generateGenderReport($start, $end)
	{
		$genderReport = User::select('gender', \DB::raw("count(users.gender) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.gender')->get();
		
		return $genderReport;
	}

	/**
	 * Generate reports by marital status
	 *
	 * @return Response
	 */
	public function generateMaritalStatusReport($start, $end)
	{
		$maritalStatusReport = User::select('maritalStatus', \DB::raw("count(users.maritalStatus) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.maritalStatus')->get();
		
		return $maritalStatusReport;
	}

	/**
	 * Generate reports by religion
	 *
	 * @return Response
	 */
	public function generateReligionReport($start, $end)
	{
		$religionReport = User::select('religion', \DB::raw("count(users.religion) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.religion')->get();
		
		return $religionReport;
	}

	/**
	 * Generate reports by education
	 *
	 * @return Response
	 */
	public function generateEducationReport($start, $end)
	{
		$educationReport = User::select('education', \DB::raw("count(users.education) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.education')->get();
		
		return $educationReport;
	}

	/**
	 * Generate reports by profession
	 *
	 * @return Response
	 */
	public function generateProfessionReport($start, $end)
	{
		$professionReport = User::select('profession', \DB::raw("count(users.profession) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.profession')->get();
		
		return $professionReport;
	}

	/**
	 * Generate reports by income
	 *
	 * @return Response
	 */
	public function generateIncomeReport($start, $end)
	{
		$incomeReport = User::select('income', \DB::raw("count(users.income) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.income')->get();
		
		return $incomeReport;
	}

	/**
	 * Generate reports by soccer team
	 *
	 * @return Response
	 */
	public function generateSoccerTeamReport($start, $end)
	{
		$soccerTeamReport = User::select('soccerTeam', \DB::raw("count(users.soccerTeam) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.soccerTeam')->get();
		
		return $soccerTeamReport;
	}
}
