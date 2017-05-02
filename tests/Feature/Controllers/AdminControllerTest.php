<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\DuskServiceProvider;

class AdminControllerTest extends TestCase
{

	use DatabaseMigrations;
	use DatabaseTransactions;
	use WithoutMiddleware;

    /**
     * Testing dashboard method
     *
     * @return void
     */
    public function testDashboard()
    {
    	$response = $this->get('/admin/painel');
        $response->assertStatus(200);
    }

    /**
     * Testing list method
     *
     * @return void
     */
    public function testList()
    {
    	$response = $this->get('/admin/administradores/listar');
        $response->assertStatus(200);    	
    }

    /**
     * Testing index method
     *
     * @return void
     */
    public function testIndex()
    {
    	$admin = new \App\Models\Admin();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@agradecaaqui.net';
    	$admin->password = bcrypt('teste123');
    	$admin->save();

    	$this->call('GET', '/admin/administradores')
    		 ->assertJsonStructure([
    		 		'pagination' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'from', 'to'
    		 		],
    		 		'data' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url', 'from', 'to', 'data' => [
    		 				0 => [
    		 					'id', 'name', 'email', 'created_at', 'updated_at', 'deleted_at'
    		 				]
    		 			]	
    		 		],

    		 	]);    	
    }

    /**
     * Testing store method
     *
     * @return void
     */
    public function testStore()
    {
    	$admin = new \App\Models\Admin();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@agradecaaqui.net';
    	$admin->password = bcrypt('teste123');
    	$admin->save();

    	$this->assertDatabaseHas('admins', ['email' => 'admin@agradecaaqui.net']);    	
    }

    /**
     * Testing show method
     *
     * @return void
     */
    public function testShow()
    {
    	$admin = new \App\Models\Admin();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@agradecaaqui.net';
    	$admin->password = bcrypt('teste123');
    	$admin->save();

    	$admin::findOrFail(1);
    	$email = $admin->email;

    	$this->assertEquals('admin@agradecaaqui.net', $email);    	
    }

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
    {
    	$admin = new \App\Models\Admin();
    	$admin->name = 'Admin';
    	$admin->email = 'admin@agradecaaqui.net';
    	$admin->password = bcrypt('teste123');
    	$admin->save();

    	$admin::findOrFail(1);
    	$admin->email = 'admin@domain.com';
    	$admin->save();

    	$this->assertEquals('admin@domain.com', $admin->email);
    }

    /**
     * Testing destroy method
     *
     * @return void
     */
    public function testDestroy()
    {
    	$admin1 = new \App\Models\Admin();
    	$admin1->name = 'Admin 1';
    	$admin1->email = 'admin1@agradecaaqui.net';
    	$admin1->password = bcrypt('teste123');
    	$admin1->save();

    	$admin2 = new \App\Models\Admin();
    	$admin2->name = 'Admin 2';
    	$admin2->email = 'admin2@agradecaaqui.net';
    	$admin2->password = bcrypt('teste123');
    	$admin2->save();

    	$admin = \App\Models\Admin::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('admins', ['deleted_at' => null, 'id' => 1]);
    }
}
