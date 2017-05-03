<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAdminControllerTest extends TestCase
{
    use DatabaseMigrations;
	use DatabaseTransactions;
	use WithoutMiddleware;

    /**
     * Testing list method
     *
     * @return void
     */
    public function testList()
    {
    	$response = $this->get('/admin/usuarios/listar');
        $response->assertStatus(200);    	
    }

    /**
     * Testing index method
     *
     * @return void
     */
    public function testIndex()
    {
    	$user = new \App\Models\User();
    	$user->name = 'User1';
    	$user->surName = 'Surname';
    	$user->email = 'user1@mail.com';
    	$user->gender = 'male';
    	$user->dateOfBirth = '21/03/1967';
    	$user->telephone = '(21)3292-2182';
    	$user->city = 'Rio de Janeiro';
    	$user->state = 'Rio de Janeiro';
    	$user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$this->call('GET', '/admin/usuarios')
    		 ->assertJsonStructure([
    		 		'pagination' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'from', 'to'
    		 		],
    		 		'data' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url', 'from', 'to', 'data' => [
    		 				0 => [
    		 					'id', 'name', 'surName', 'gender', 'dateOfBirth', 'telephone', 'city', 'state', 'country', 'email', 'education', 'profession', 'maritalStatus', 'religion', 'ethnicity', 'income', 'sport', 'soccerTeam', 'height', 'weight', 'hasCar', 'hasChildren', 'liveWith', 'pet', 'registerType', 'photo', 'created_at', 'updated_at', 'deleted_at'
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
    	$user = new \App\Models\User();
    	$user->name = 'User2';
    	$user->surName = 'Surname';
    	$user->email = 'user2@mail.com';
    	$user->gender = 'male';
    	$user->dateOfBirth = '21/03/1967';
    	$user->telephone = '(21)3292-2182';
    	$user->city = 'Rio de Janeiro';
    	$user->state = 'Rio de Janeiro';
    	$user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$this->assertDatabaseHas('users', ['name' => 'User2']);    	
    }

    /**
     * Testing show method
     *
     * @return void
     */
    public function testShow()
    {
    	$user = new \App\Models\User();
    	$user->name = 'User3';
    	$user->surName = 'Surname';
    	$user->email = 'user3@mail.com';
    	$user->gender = 'male';
    	$user->dateOfBirth = '21/03/1967';
    	$user->telephone = '(21)3292-2182';
    	$user->city = 'Rio de Janeiro';
    	$user->state = 'Rio de Janeiro';
    	$user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$user = \App\Models\User::findOrFail(1);
    	
    	$this->assertEquals('User3', $user->name);    	
    }

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
    {
    	$user = new \App\Models\User();
    	$user->name = 'User4';
    	$user->surName = 'Surname';
    	$user->email = 'user4@mail.com';
    	$user->gender = 'male';
    	$user->dateOfBirth = '21/03/1967';
    	$user->telephone = '(21)3292-2182';
    	$user->city = 'Rio de Janeiro';
    	$user->state = 'Rio de Janeiro';
    	$user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$user = \App\Models\User::findOrFail(1);
    	$user->name = 'User 4';
    	$user->save();

    	$this->assertEquals('User 4', $user->name);
    }

    /**
     * Testing destroy method
     *
     * @return void
     */
    public function testDestroy()
    {
    	$user1 = new \App\Models\User();
    	$user1->name = 'User 1';
    	$user1->surName = 'Surname';
    	$user1->email = 'user_1@mail.com';
    	$user1->gender = 'male';
    	$user1->dateOfBirth = '21/03/1967';
    	$user1->telephone = '(21)3292-2182';
    	$user1->city = 'Rio de Janeiro';
    	$user1->state = 'Rio de Janeiro';
    	$user1->photo = 'images/user1.jpg';
    	$user1->password = bcrypt('teste123');
    	$user1->save();

    	$user2 = new \App\Models\User();
    	$user2->name = 'User 2';
    	$user2->surName = 'Surname';
    	$user2->email = 'user_2@mail.com';
    	$user2->gender = 'male';
    	$user2->dateOfBirth = '21/03/1967';
    	$user2->telephone = '(21)3292-2182';
    	$user2->city = 'Rio de Janeiro';
    	$user2->state = 'Rio de Janeiro';
    	$user2->photo = 'images/user1.jpg';
    	$user2->password = bcrypt('teste123');
    	$user2->save();

    	$user = \App\Models\User::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('users', ['deleted_at' => null, 'id' => 1]);
    }
}
