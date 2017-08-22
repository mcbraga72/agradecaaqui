<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Response;

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
	
	/**
	 * Generate a custom report
	 *
	 * @return Response
	 */
	public function generateCustomReport($type, $start, $end)
	{		
		$customReport = User::select('users.' . $type, \DB::raw("count(users.$type) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.' . $type)->get();
		
		//dd($customReport);
		return $customReport;
	}

	/**
	 * Export state data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportStateData($start, $end)
	{
		$thanksByStates = User::select('state', \DB::raw("count(users.state) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.state')->get();

        $filename = 'agradecimentos-por-estado.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Estado', 'Número de agradecimentos'));

        foreach($thanksByStates as $thanksByState) {
        	if ($thanksByState['state'] == '' || $thanksByState['state'] == null) {
        		$thanksByState['state'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByState['state'], $thanksByState['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-estado.csv', $headers);
	}

	/**
	 * Export city data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportCityData($start, $end)
	{
		$thanksByCities = User::select('city', \DB::raw("count(users.city) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.city')->get();

        $filename = 'agradecimentos-por-cidade.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Cidade', 'Número de agradecimentos'));

        foreach($thanksByCities as $thanksByCity) {
        	if ($thanksByCity['city'] == '' || $thanksByCity['city'] == null) {
        		$thanksByCity['city'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByCity['city'], $thanksByCity['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-cidade.csv', $headers);
	}

	/**
	 * Export gender data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportGenderData($start, $end)
	{
		$thanksByGenders = User::select('gender', \DB::raw("count(users.gender) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.gender')->get();

        $filename = 'agradecimentos-por-genero.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Gênero', 'Número de agradecimentos'));

        foreach($thanksByGenders as $thanksByGender) {
        	if ($thanksByGender['gender'] == '' || $thanksByGender['gender'] == null) {
        		$thanksByGender['gender'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByGender['gender'], $thanksByGender['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-genero.csv', $headers);
	}

	/**
	 * Export marital status data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportMaritalStatusData($start, $end)
	{
		$thanksByMaritalStatuses = User::select('maritalStatus', \DB::raw("count(users.maritalStatus) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.maritalStatus')->get();

        $filename = 'agradecimentos-por-estado-civil.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Estado civil', 'Número de agradecimentos'));

        foreach($thanksByMaritalStatuses as $thanksByMaritalStatus) {
        	if ($thanksByMaritalStatus['maritalStatus'] == '' || $thanksByMaritalStatus['maritalStatus'] == null) {
        		$thanksByMaritalStatus['maritalStatus'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByMaritalStatus['maritalStatus'], $thanksByMaritalStatus['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-estado-civil.csv', $headers);
	}

	/**
	 * Export religion data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportReligionData($start, $end)
	{
		$thanksByReligions = User::select('religion', \DB::raw("count(users.religion) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.religion')->get();

        $filename = 'agradecimentos-por-religiao.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Religião', 'Número de agradecimentos'));

        foreach($thanksByReligions as $thanksByReligion) {
        	if ($thanksByReligion['religion'] == '' || $thanksByReligion['religion'] == null) {
        		$thanksByReligion['religion'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByReligion['religion'], $thanksByReligion['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-religiao.csv', $headers);
	}

	/**
	 * Export education data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportEducationData($start, $end)
	{
		$thanksByEducationLevels = User::select('education', \DB::raw("count(users.education) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.education')->get();

        $filename = 'agradecimentos-por-escolaridade.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Escolaridade', 'Número de agradecimentos'));

        foreach($thanksByEducationLevels as $thanksByEducationLevel) {
        	if ($thanksByEducationLevel['education'] == '' || $thanksByEducationLevel['education'] == null) {
        		$thanksByEducationLevel['education'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByEducationLevel['education'], $thanksByEducationLevel['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-escolaridade.csv', $headers);
	}

	/**
	 * Export profession data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportProfessionData($start, $end)
	{
		$thanksByProfessions = User::select('profession', \DB::raw("count(users.profession) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.profession')->get();

        $filename = 'agradecimentos-por-profissao.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Profissão', 'Número de agradecimentos'));

        foreach($thanksByProfessions as $thanksByProfession) {
        	if ($thanksByProfession['profession'] == '' || $thanksByProfession['profession'] == null) {
        		$thanksByProfession['profession'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByProfession['profession'], $thanksByProfession['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-profissao.csv', $headers);
	}

	/**
	 * Export income data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportIncomeData($start, $end)
	{
		$thanksByIncomeLevels = User::select('income', \DB::raw("count(users.income) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.income')->get();

        $filename = 'agradecimentos-por-renda.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Renda', 'Número de agradecimentos'));

        foreach($thanksByIncomeLevels as $thanksByIncomeLevel) {
        	if ($thanksByIncomeLevel['income'] == '' || $thanksByIncomeLevel['income'] == null) {
        		$thanksByIncomeLevel['income'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksByIncomeLevel['income'], $thanksByIncomeLevel['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-renda.csv', $headers);
	}

	/**
	 * Export soccer team data to a CSV file.
	 *
	 * @return Response
	 */
	public function exportSoccerTeamData($start, $end)
	{
		$thanksBySoccerTeams = User::select('soccerTeam', \DB::raw("count(users.soccerTeam) as thanks"))->whereBetween('thanksDateTime', array(new Carbon($start), new Carbon($end)))->join('enterprise_thanks', 'enterprise_thanks.user_id', '=', 'users.id')->groupBy('users.soccerTeam')->get();

        $filename = 'agradecimentos-por-time-de-futebol.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Time', 'Número de agradecimentos'));

        foreach($thanksBySoccerTeams as $thanksBySoccerTeam) {
        	if ($thanksBySoccerTeam['soccerTeam'] == '' || $thanksBySoccerTeam['soccerTeam'] == null) {
        		$thanksBySoccerTeam['soccerTeam'] = "Não informado";
        	}
        	fputcsv($handle, array($thanksBySoccerTeam['soccerTeam'], $thanksBySoccerTeam['thanks']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-por-time-de-futebol.csv', $headers);
	}
}
