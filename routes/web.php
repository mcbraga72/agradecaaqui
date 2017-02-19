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

/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');
*/


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
Route::get('/cadastro', 'SiteController@register');


// Users Area

Route::get('/app', 'AppController@dashboard');
Route::get('/app/perfil', 'AppController@edit');
Route::put('/app/perfil/{id}', 'AppController@update');
	
Route::get('/app/agradecimentos-empresas', 'EnterpriseThanksAppController@index');
Route::get('/app/agradecimento-empresa/criar', 'EnterpriseThanksAppController@create');
Route::post('/app/agradecimento-empresa', 'EnterpriseThanksAppController@store');
Route::get('/app/agradecimento-empresa/{id}', 'EnterpriseThanksAppController@show');
Route::get('/app/agradecimento-empresa/{id}/editar', 'EnterpriseThanksAppController@edit');
Route::put('/app/agradecimento-empresa/{id}', 'EnterpriseThanksAppController@update');
Route::delete('/app/agradecimento-empresa/{id}', 'EnterpriseThanksAppController@destroy');

Route::get('/app/agradecimentos-usuarios', 'UserThanksAppController@index');
Route::get('/app/agradecimento-usuario/criar', 'UserThanksAppController@create');
Route::post('/app/agradecimento-usuario', 'UserThanksAppController@store');
Route::get('/app/agradecimento-usuario/{id}', 'UserThanksAppController@show');
Route::get('/app/agradecimento-usuario/{id}/editar', 'UserThanksAppController@edit');
Route::put('/app/agradecimento-usuario/{id}', 'UserThanksAppController@update');
Route::delete('/app/agradecimento-usuario/{id}', 'UserThanksAppController@destroy');

// Admin

Route::get('/admin', 'AdminController@index');
Route::get('/admin/painel', 'AdminController@dashboard');

Route::get('/admin/usuarios', 'UserAdminController@index');
Route::get('/admin/usuario/criar', 'UserAdminController@create');
Route::post('/admin/usuario', 'UserAdminController@store');
Route::get('/admin/usuario/{id}', 'UserAdminController@show');
Route::get('/admin/usuario/{id}/editar', 'UserAdminController@edit');
Route::put('/admin/usuario/{id}', 'UserAdminController@update');
Route::delete('/admin/usuario/{id}', 'UserAdminController@destroy');

Route::get('/admin/empresas', 'EnterpriseAdminController@index');
Route::get('/admin/empresa/criar', 'EnterpriseAdminController@create');
Route::post('/admin/empresa', 'EnterpriseAdminController@store');
Route::get('/admin/empresa/{id}', 'EnterpriseAdminController@show');
Route::get('/admin/empresa/{id}/editar', 'EnterpriseAdminController@edit');
Route::post('/admin/empresa/{id}', 'EnterpriseAdminController@update');
Route::delete('/admin/empresa/{id}', 'EnterpriseAdminController@destroy');

Route::get('/admin/categorias', 'CategoryAdminController@index');
Route::get('/admin/categoria/criar', 'CategoryAdminController@create');
Route::post('/admin/categoria', 'CategoryAdminController@store');
Route::get('/admin/categoria/{id}', 'CategoryAdminController@show');
Route::get('/admin/categoria/{id}/editar', 'CategoryAdminController@edit');
Route::put('/admin/categoria/{id}', ['as' => 'category.update', 'uses' => 'CategoryAdminController@update']);
Route::delete('/admin/categoria/{id}', ['as' => 'category.delete', 'uses' => 'CategoryAdminController@destroy']);

Route::get('/admin/agradecimentos-empresas', 'EnterpriseThanksAdminController@index');
Route::get('/admin/agradecimento-empresa/criar', 'EnterpriseThanksAdminController@create');
Route::post('/admin/agradecimento-empresa', 'EnterpriseThanksAdminController@store');
Route::get('/admin/agradecimento-empresa/{id}', 'EnterpriseThanksAdminController@show');
Route::get('/admin/agradecimento-empresa/{id}/editar', 'EnterpriseThanksAdminController@edit');
Route::put('/admin/agradecimento-empresa/{id}', 'EnterpriseThanksAdminController@update');
Route::delete('/admin/agradecimento-empresa/{id}', 'EnterpriseThanksAdminController@destroy');
Route::get('autocomplete', array('as'=>'autocomplete','uses'=>'EnterpriseThanksAdminController@autocomplete'));

Route::get('/admin/agradecimentos-usuarios', 'UserThanksAdminController@index');
Route::get('/admin/agradecimento-usuario/criar', 'UserThanksAdminController@create');
Route::post('/admin/agradecimento-usuario', 'UserThanksAdminController@store');
Route::get('/admin/agradecimento-usuario/{id}', 'UserThanksAdminController@show');
Route::get('/admin/agradecimento-usuario/{id}/editar', 'UserThanksAdminController@edit');
Route::put('/admin/agradecimento-usuario/{id}', 'UserThanksAdminController@update');
Route::delete('/admin/agradecimento-usuario/{id}', 'UserThanksAdminController@destroy');

Route::get('/admin/relatorios', 'ReportAdminController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');
