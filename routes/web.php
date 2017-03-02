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
Route::post('/entrar', 'SiteController@loginWithData');
Route::get('/cadastro', 'SiteController@register');


// User's Area

Route::get('/app', 'AppController@dashboard');
Route::get('/app/perfil', 'AppController@edit');
Route::put('/app/perfil/{id}', 'AppController@update');
Route::get('/app/agradecimentos', 'AppController@thanks');
Route::get('/app/empresa/criar', 'AppController@createEnterprise');
Route::post('/app/empresa', 'AppController@storeEnterprise');
Route::post('/app/busca/empresa', 'AppController@findEnterprise');
	
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


// Enterprise's Area

// 1 - Auth

Route::get('/empresa/entrar', 'EnterpriseAuth\LoginController@showLoginForm');
Route::post('/empresa/entrar', 'EnterpriseAuth\LoginController@login');
Route::post('/empresa/logout', 'EnterpriseAuth\LoginController@logout');

Route::post('/empresa/enviar-senha', 'EnterpriseAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/empresa/trocar-senha', 'EnterpriseAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/empresa/alterar-senha', 'EnterpriseAuth\ResetPasswordController@reset');
Route::get('/empresa/alterar-senha/{token}', 'EnterpriseAuth\ResetPasswordController@showResetForm');

Route::get('/empresa/cadastro', 'EnterpriseAuth\RegisterController@showRegistrationForm');
Route::post('/empresa/cadastro', 'EnterpriseAuth\RegisterController@register');

// 2 - Enterprise Admin

Route::get('/empresa/painel', 'EnterpriseAreaController@dashboard');
Route::get('/empresa/perfil', 'EnterpriseAreaController@editProfile');
Route::put('/empresa/perfil/{id}', 'EnterpriseAreaController@updateProfile');
Route::get('/empresa/agradecimentos', 'EnterpriseAreaController@thanks');
//Route::get('/empresa/relatorios', 'ReportEnterpriseController@index');



// Admin's Area

// 1 - Auth

Route::get('/admin/entrar', 'AdminAuth\LoginController@showLoginForm');
Route::post('/admin/entrar', 'AdminAuth\LoginController@login');
Route::post('/admin/logout', 'AdminAuth\LoginController@logout');

Route::post('/admin/enviar-senha', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
Route::get('/admin/trocar-senha', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');

Route::post('/admin/alterar-senha', 'AdminAuth\ResetPasswordController@reset');
Route::get('/admin/alterar-senha/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

Route::get('/admin/cadastro', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('/admin/cadastro', 'AdminAuth\RegisterController@register');

// 2 - Admin

Route::get('/admin/painel', 'AdminController@dashboard');
Route::get('/admin/administradores/listar', 'AdminController@list');
/*Route::get('/admin/administrador/criar', 'AdminController@create');
Route::post('/admin/administrador', 'AdminController@store');
Route::get('/admin/administrador/{id}', 'AdminController@show');
Route::get('/admin/administrador/{id}/editar', 'AdminController@edit');
Route::put('/admin/administrador/{id}', 'AdminController@update');
Route::delete('/admin/administrador/{id}', ['as' => 'admin.delete', 'uses' => 'AdminController@destroy']);*/
Route::resource('/admin/administradores','AdminController');

Route::get('/admin/usuarios', 'UserAdminController@index');
Route::get('/admin/usuario/criar', 'UserAdminController@create');
Route::post('/admin/usuario', 'UserAdminController@store');
Route::get('/admin/usuario/{id}', 'UserAdminController@show');
Route::get('/admin/usuario/{id}/editar', 'UserAdminController@edit');
Route::put('/admin/usuario/{id}', 'UserAdminController@update');
Route::delete('/admin/usuario/{id}', ['as' => 'user.delete', 'uses' => 'UserAdminController@destroy']);

Route::get('/admin/empresas', 'EnterpriseAdminController@index');
Route::get('/admin/empresa/criar', 'EnterpriseAdminController@create');
Route::post('/admin/empresa', 'EnterpriseAdminController@store');
Route::get('/admin/empresa/{id}', 'EnterpriseAdminController@show');
Route::get('/admin/empresa/{id}/editar', 'EnterpriseAdminController@edit');
Route::post('/admin/empresa/{id}', 'EnterpriseAdminController@update');
Route::delete('/admin/empresa/{id}', ['as' => 'enterprise.delete', 'uses' => 'EnterpriseAdminController@destroy']);

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
Route::delete('/admin/agradecimento-empresa/{id}', ['as' => 'enterpriseThanks.delete', 'uses' => 'EnterpriseThanksAdminController@destroy']);
Route::get('autocomplete', array('as'=>'autocomplete','uses'=>'EnterpriseThanksAdminController@autocomplete'));

Route::get('/admin/agradecimentos-usuarios', 'UserThanksAdminController@index');
Route::get('/admin/agradecimento-usuario/criar', 'UserThanksAdminController@create');
Route::post('/admin/agradecimento-usuario', 'UserThanksAdminController@store');
Route::get('/admin/agradecimento-usuario/{id}', 'UserThanksAdminController@show');
Route::get('/admin/agradecimento-usuario/{id}/editar', 'UserThanksAdminController@edit');
Route::put('/admin/agradecimento-usuario/{id}', 'UserThanksAdminController@update');
Route::delete('/admin/agradecimento-usuario/{id}', ['as' => 'userThanks.delete', 'uses' => 'UserThanksAdminController@destroy']);

Route::get('/admin/relatorios', 'ReportAdminController@index');


Auth::routes();

Route::get('/home', 'HomeController@index');
