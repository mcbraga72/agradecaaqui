<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAppControllerTest extends TestCase
{
	use DatabaseMigrations;
	use DatabaseTransactions;
	use WithoutMiddleware;

    /**
     * Testing store method
     *
     * @return void
     */
    public function testStore()
    {
    	$user = new \App\Models\User();
    	$user->name = 'User';
    	$user->surName = 'Surname';
    	$user->email = 'user@mail.com';
    	$user->gender = 'male';
    	$user->dateOfBirth = '21/03/1967';
    	$user->telephone = '(21)3292-2182';
    	$user->city = 'Rio de Janeiro';
    	$user->state = 'Rio de Janeiro';
    	$user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$this->assertDatabaseHas('users', ['name' => 'User']);    	
    }

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
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
    	$user->country = 'Brasil';
        $user->education = 'Mestrado';
        $user->profession = 'Desenvolvedor de Sistemas';
        $user->maritalStatus = 'Casado';
        $user->religion = 'Católico';
        $user->ethnicity = 'Branco';
        $user->income = 'Acima de R$ 10.000,00';
        $user->sport = implode(' ', ['futebol', 'musculação']);
        $user->soccerTeam = 'flamengo';
        $user->height = 1.82;
        $user->weight = 74;
        $user->hasCar = 1;
        $user->hasChildren = 1;
        $user->liveWith = 'Com a família';
        $user->pet = implode(' ', ['cachorro', 'peixe']);
        $user->photo = 'images/user1.jpg';
    	$user->password = bcrypt('teste123');
        $user->registerType = 'Complete';
    	$user->save();

    	$this->assertEquals('flamengo', $user->soccerTeam);
    }
}
