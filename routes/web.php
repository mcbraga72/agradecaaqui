<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// User's Auth

Auth::routes();


// Admin's Auth

Route::get('/admin/entrar', 'AdminAuth\LoginController@showLoginForm');
Route::post('/admin/entrar', 'AdminAuth\LoginController@login');
Route::post('/admin/logout', 'AdminAuth\LoginController@logout');

Route::post('/admin/enviar-senha', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/admin/trocar-senha', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/admin/alterar-senha', 'AdminAuth\ResetPasswordController@reset');
Route::get('/admin/alterar-senha/{token}', 'AdminAuth\ResetPasswordController@showResetForm');


// Enterprise's Auth

Route::get('/empresa/entrar', 'EnterpriseAuth\LoginController@showLoginForm');
Route::post('/empresa/entrar', 'EnterpriseAuth\LoginController@login');
Route::post('/empresa/logout', 'EnterpriseAuth\LoginController@logout');

Route::post('/empresa/enviar-senha', 'EnterpriseAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/empresa/trocar-senha', 'EnterpriseAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/empresa/alterar-senha', 'EnterpriseAuth\ResetPasswordController@reset');
Route::get('/empresa/alterar-senha/{token}', 'EnterpriseAuth\ResetPasswordController@showResetForm');



// Social login
 
Route::get('/redirect/facebook', 'SocialAuthController@redirectFacebook');
Route::get('/callback/facebook', 'SocialAuthController@callbackFacebook');

Route::get('/redirect/google', 'SocialAuthController@redirectGoogle');
Route::get('/callback/google', 'SocialAuthController@callbackGoogle');


// Site 

Route::get('/', 'SiteController@index');
Route::get('/quem-somos', 'SiteController@about');
Route::get('/contato', 'SiteController@contact');
Route::get('/apoiadores', 'SiteController@support');
Route::get('/entrar', 'SiteController@login');
Route::post('/entrar', 'SiteController@loginWithData');
Route::get('/cadastro', 'SiteController@register');
Route::post('/busca', 'SiteController@findThanks');
Route::post('/mensagem', 'SiteController@sendMessageContactForm');
Route::post('/cadastro/empresa', 'SiteController@storeEnterprise');



// Protected URLs

Route::group(['middleware' => 'auth'], function () {

	// User's Area

	Route::get('/app', 'AppController@dashboard');
	Route::resource('/app/usuario','UserAppController');
	Route::post('/app/alterar-senha', 'AppController@changePassword');
	Route::post('/app/alterar-avatar/{id}', 'AppController@updateAvatar');
	Route::get('/app/agradecimentos', 'AppController@thanks');
	Route::post('/app/agradecimentos/busca', 'AppController@findThanks');
	Route::post('/app/empresa', 'AppController@storeEnterprise');
	Route::get('/app/busca/empresa', 'AppController@findEnterprise');
	Route::get('/app/categorias', 'AppController@getCategories');
	Route::get('/app/empresas', 'AppController@getEnterprises');

	Route::get('/app/agradecimentos-empresas', 'EnterpriseThanksAppController@index');
	Route::post('/app/agradecimento-empresa', 'EnterpriseThanksAppController@store');
	Route::post('/app/agradecimentos-empresas', 'EnterpriseThanksAppController@find');
	Route::get('/app/agradecimento-empresa/{hash}', ['as' => 'enterprise-thanks.show', 'uses' => 'EnterpriseThanksAppController@show']);
	Route::get('/app/agradecimento-empresa/{id}/editar', 'EnterpriseThanksAppController@edit');
	Route::put('/app/agradecimento-empresa/{id}', 'EnterpriseThanksAppController@update');
	Route::delete('/app/agradecimento-empresa/{id}', 'EnterpriseThanksAppController@destroy');

	Route::get('/app/agradecimentos-usuarios', 'UserThanksAppController@index');
	Route::post('/app/agradecimento-usuario', 'UserThanksAppController@store');
	Route::post('/app/agradecimentos-usuarios', 'UserThanksAppController@find');
	Route::get('/app/agradecimento-usuario/{hash}', ['as' => 'user-thanks.show', 'uses' => 'UserThanksAppController@show']);
	Route::get('/app/agradecimento-usuario/{id}/editar', 'UserThanksAppController@edit');
	Route::put('/app/agradecimento-usuario/{id}', 'UserThanksAppController@update');
	Route::delete('/app/agradecimento-usuario/{id}', 'UserThanksAppController@destroy');

});


Route::group(['middleware' => 'auth:enterprises'], function () {

	// Enterprise's Area

	Route::get('/empresa/painel', 'EnterpriseAreaController@dashboard');
	Route::get('/empresa/perfil/editar', 'EnterpriseAreaController@editProfile');
	Route::post('/empresa/perfil/atualizar', 'EnterpriseAreaController@updateProfile');
	Route::post('/empresa/perfil/alterar-senha/{id}', 'EnterpriseAreaController@changePassword');
	Route::post('/empresa/alterar-logo', 'EnterpriseAreaController@updateLogo');
	Route::get('/empresa/agradecimentos/listar', 'EnterpriseAreaController@list');
	Route::get('/empresas/agradecimentos', ['as' => 'agradecimentos.index', 'uses' => 'EnterpriseAreaController@index']);
	Route::post('/empresa/agradecimento', 'EnterpriseAreaController@storeReplica');
	Route::get('/empresa/premium', 'EnterpriseAreaController@premium');

	Route::get('/empresa/relatorios', 'ReportEnterpriseController@index');
	Route::get('/empresa/api/relatorios/estado', 'ReportEnterpriseController@generateStateReport');
	Route::get('/empresa/api/relatorios/cidade', 'ReportEnterpriseController@generateCityReport');
	Route::get('/empresa/api/relatorios/sexo', 'ReportEnterpriseController@generateGenderReport');
	Route::get('/empresa/api/relatorio/{type}/{start}/{end}', 'ReportEnterpriseController@generateCustomReport');

});


Route::group(['middleware' => 'auth:admins'], function () {

	// Admin's Area

	Route::get('/admin/painel', 'AdminController@dashboard');

	Route::get('/admin/administradores/listar', 'AdminController@list');
	Route::resource('/admin/administradores','AdminController');

	Route::get('/admin/categorias/listar', 'CategoryAdminController@list');
	Route::resource('/admin/categorias','CategoryAdminController');

	Route::get('/admin/empresas/listar', 'EnterpriseAdminController@list');
	Route::resource('/admin/empresas','EnterpriseAdminController');

	Route::get('/admin/agradecimentos-empresas/listar', 'EnterpriseThanksAdminController@list');
	Route::resource('/admin/agradecimentos-empresas','EnterpriseThanksAdminController');

	Route::get('/admin/usuarios/listar', 'UserAdminController@list');
	Route::resource('/admin/usuarios','UserAdminController');

	Route::get('/admin/agradecimentos-usuarios/listar', 'UserThanksAdminController@list');
	Route::resource('/admin/agradecimentos-usuarios','UserThanksAdminController');

	Route::put('/admin/empresa/aprovar/{id}', 'EnterpriseAdminController@approveRegister');

	Route::get('/admin/relatorios', 'ReportAdminController@index');
	Route::get('/admin/api/relatorios/estado', 'ReportAdminController@generateStateReport');
	Route::get('/admin/api/relatorios/cidade', 'ReportAdminController@generateCityReport');
	Route::get('/admin/api/relatorios/sexo', 'ReportAdminController@generateGenderReport');
	Route::get('/admin/api/relatorio/{type}/{start}/{end}', 'ReportAdminController@generateCustomReport');

});