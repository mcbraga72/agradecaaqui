<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserThanksAppControllerTest extends TestCase
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

    	$userThanks = new \App\Models\UserThanks();
    	$userThanks->user_id = $user->id;
    	$userThanks->receiptName = 'John Doe';
    	$userThanks->receiptEmail = 'john.doe@mail.com';
    	$userThanks->content = 'Teste de agradecimentos para usuários.';
    	$userThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$userThanks->save();

    	$this->assertDatabaseHas('user_thanks', ['content' => 'Teste de agradecimentos para usuários.']);    	
    }

    /**
     * Testing show method
     *
     * @return void
     */
    public function testShow()
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

    	$userThanks = new \App\Models\UserThanks();
    	$userThanks->user_id = $user->id;
    	$userThanks->receiptName = 'John Doe';
    	$userThanks->receiptEmail = 'john.doe@mail.com';
    	$userThanks->content = 'Teste de agradecimentos para usuários.';
    	$userThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$userThanks->save();

    	$userThanks = \App\Models\UserThanks::findOrFail(1);
    	$content = $userThanks->content;

    	$this->assertEquals('Teste de agradecimentos para usuários.', $content);    	
    }

    /**
     * Testing find method
     *
     * @return void
     */
    public function testFind()
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

    	$users = \App\Models\User::where('name', 'LIKE', '%User%')->orderBy('name', 'asc')->get();

    	$this->assertTrue($users->contains('name', 'User2'));
    }

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
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

    	$userThanks = new \App\Models\UserThanks();
    	$userThanks->user_id = $user->id;
    	$userThanks->receiptName = 'John Doe';
    	$userThanks->receiptEmail = 'john.doe@mail.com';
    	$userThanks->content = 'Teste de agradecimentos para usuários.';
    	$userThanks->thanksDateTime = '2017-05-03 10:21:21';    	
    	$userThanks->save();

    	$userThanks = \App\Models\UserThanks::findOrFail(1);
    	$userThanks->content = 'Atualizando o agradecimento.';
    	$userThanks->save();

    	$userThanks = \App\Models\UserThanks::findOrFail(1);

    	$this->assertEquals('Atualizando o agradecimento.', $userThanks->content);
    }

    /**
     * Testing destroy method
     *
     * @return void
     */
    public function testDestroy()
    {
    	$user1 = new \App\Models\User();
    	$user1->name = 'User1';
    	$user1->surName = 'Surname';
    	$user1->email = 'user1@mail.com';
    	$user1->gender = 'male';
    	$user1->dateOfBirth = '21/03/1967';
    	$user1->telephone = '(21)3292-2182';
    	$user1->city = 'Rio de Janeiro';
    	$user1->state = 'Rio de Janeiro';
    	$user1->photo = 'images/user1.jpg';
    	$user1->password = bcrypt('teste123');
    	$user1->save();

    	$userThanks1 = new \App\Models\UserThanks();
    	$userThanks1->user_id = $user1->id;
    	$userThanks1->receiptName = 'John Doe';
    	$userThanks1->receiptEmail = 'john.doe@mail.com';
    	$userThanks1->content = 'Teste de agradecimentos para usuários.';
    	$userThanks1->thanksDateTime = '2017-05-03 10:21:21';
    	$userThanks1->save();


    	$user2 = new \App\Models\User();
    	$user2->name = 'User2';
    	$user2->surName = 'Surname';
    	$user2->email = 'user2@mail.com';
    	$user2->gender = 'male';
    	$user2->dateOfBirth = '21/03/1967';
    	$user2->telephone = '(21)3292-2182';
    	$user2->city = 'Rio de Janeiro';
    	$user2->state = 'Rio de Janeiro';
    	$user2->photo = 'images/user1.jpg';
    	$user2->password = bcrypt('teste123');
    	$user2->save();

    	$userThanks2 = new \App\Models\UserThanks();
    	$userThanks2->user_id = $user2->id;
    	$userThanks2->receiptName = 'John Doe';
    	$userThanks2->receiptEmail = 'john.doe@mail.com';
    	$userThanks2->content = 'Teste de agradecimentos para usuários.';
    	$userThanks2->thanksDateTime = '2017-05-03 10:21:21';
    	$userThanks2->save();

    	$userThanks = \App\Models\UserThanks::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('enterprise_thanks', ['deleted_at' => null, 'id' => 1]);
    }
}
