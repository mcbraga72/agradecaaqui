<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\EnterpriseThanks;
use App\Models\User;
use App\Models\UserThanks;
use Illuminate\Http\Request;
use Response;

class ServiceAdminController extends Controller
{
   /**
     *
     * Export enterprise's register to a CSV file.
     * 
     * @return Response
     * 
     */
    public function exportEnterpriseRegister()
    {
        $enterprises = Enterprise::orderBy('name')->get();
        $filename = 'empresas.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Nome', 'Contato', 'Telefone', 'E-mail', 'Site', 'Endereço', 'Perfil'));

        foreach($enterprises as $enterprise) {
            fputcsv($handle, array($enterprise['name'], $enterprise['contact'], $enterprise['telephone'], $enterprise['email'], $enterprise['site'], $enterprise['address'], $enterprise['profile']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'empresas.csv', $headers);
    }

    /**
     *
     * Export enterprise thanks register to a CSV file.
     * 
     * @return Response
     * 
     */
    public function exportEnterpriseThanksRegister()
    {
        $enterpriseThanks = EnterpriseThanks::with(['Enterprise', 'User'])->orderBy('thanksDateTime', 'desc')->get();
        $filename = 'agradecimentos-empresas.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Usuário', 'Empresa', 'Data/Hora', 'Agradecimento', 'Réplica', 'Tréplica'));

        foreach($enterpriseThanks as $enterpriseThank) {
        	$thanksDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $enterpriseThank['thanksDateTime']);
            fputcsv($handle, array($enterpriseThank['user']['name'], $enterpriseThank['enterprise']['name'], $thanksDateTime->format('d/m/Y H:i'), $enterpriseThank['content'], $enterpriseThank['replica'], $enterpriseThank['rejoinder']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-empresas.csv', $headers);
    }

    /**
     *
     * Export user's register to a CSV file.
     * 
     * @return Response
     * 
     */
    public function exportUserRegister()
    {
        $users = User::orderBy('name')->get();
        $filename = 'usuarios.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Nome', 'Telefone', 'E-mail', 'Sexo', 'Data de nascimento', 'Cidade', 'Estado', 'País', 'Escolaridade', 'Profissão', 'Estado Civil', 'Religião', 'Renda mensal', 'Esportes', 'Time de futebol', 'Altura', 'Peso', 'Possui automóvel', 'Tem filhos', 'Mora com quem', 'Animais de estimação'));

        foreach($users as $user) {
        	if ($user['hasCar'] == 1) {
        		$hasCar = 'Sim';
        	} else if ($user['hasCar'] == 0) {
        		$hasCar = 'Não';
        	} else {
        		$hasCar = '';
        	}

        	if ($user['hasChildren'] == 1) {
        		$hasChildren = 'Sim';
        	} else if ($user['hasChildren'] == 0) {
        		$hasChildren = 'Não';
        	} else {
        		$hasChildren = '';
        	}

            fputcsv($handle, array($user['name'] . ' ' . $user['surName'], $user['telephone'], $user['email'], $user['gender'], $user['dateOfBirth'], $user['city'], $user['state'], $user['country'], $user['education'], $user['profession'], $user['maritalStatus'], $user['religion'], $user['income'], $user['sport'], $user['soccerTeam'], $user['height'], $user['weight'], $hasCar, $hasChildren, $user['liveWith'], $user['pet']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'usuarios.csv', $headers);
    }

    /**
     *
     * Export user thanks register to a CSV file.
     * 
     * @return Response
     * 
     */
    public function exportUserThanksRegister()
    {
        $userThanks = UserThanks::with('User')->orderBy('thanksDateTime', 'desc')->get();
        $filename = 'agradecimentos-usuarios.csv';
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Usuário', 'Nome de quem recebeu o agradecimento', 'E-mail de quem recebeu o agradecimento', 'Data/Hora', 'Agradecimento', 'Réplica', 'Tréplica'));

        foreach($userThanks as $userThank) {
        	$thanksDateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $userThank['thanksDateTime']);
            fputcsv($handle, array($userThank['user']['name'], $userThank['receiptName'], $userThank['receiptEmail'], $thanksDateTime->format('d/m/Y H:i'), $userThank['content'], $userThank['replica'], $userThank['rejoinder']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'agradecimentos-usuarios.csv', $headers);
    }
}
