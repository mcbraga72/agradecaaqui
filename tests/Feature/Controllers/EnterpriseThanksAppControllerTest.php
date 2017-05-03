<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EnterpriseThanksAppControllerTest extends TestCase
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
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise Store';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact2@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

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

    	$enterpriseThanks = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks->user_id = $user->id;
    	$enterpriseThanks->enterprise_id = $enterprise->id;
    	$enterpriseThanks->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks->status = 'Approved';
    	$enterpriseThanks->save();

    	$this->assertDatabaseHas('enterprise_thanks', ['content' => 'Teste de agradecimentos para empresas.']);    	
    }

    /**
     * Testing show method
     *
     * @return void
     */
    public function testShow()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise Show';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact3@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

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

    	$enterpriseThanks = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks->user_id = $user->id;
    	$enterpriseThanks->enterprise_id = $enterprise->id;
    	$enterpriseThanks->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks->status = 'Approved';
    	$enterpriseThanks->save();

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1);
    	$content = $enterpriseThanks->content;

    	$this->assertEquals('Teste de agradecimentos para empresas.', $content);    	
    }

    /**
     * Testing find method
     *
     * @return void
     */
    public function testFind()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise Store';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact2@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

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

    	$enterpriseThanks = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks->user_id = $user->id;
    	$enterpriseThanks->enterprise_id = $enterprise->id;
    	$enterpriseThanks->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks->status = 'Approved';
    	$enterpriseThanks->save();

    	$this->assertDatabaseHas('enterprise_thanks', ['content' => 'Teste de agradecimentos para empresas.']);    	
    }    

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise Update';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact4@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

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

    	$enterpriseThanks = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks->user_id = $user->id;
    	$enterpriseThanks->enterprise_id = $enterprise->id;
    	$enterpriseThanks->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks->status = 'Approved';
    	$enterpriseThanks->save();

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1);
    	$enterpriseThanks->content = 'Atualizando o agradecimento.';
    	$enterpriseThanks->save();

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1);

    	$this->assertEquals('Atualizando o agradecimento.', $enterpriseThanks->content);
    }

    /**
     * Testing destroy method
     *
     * @return void
     */
    public function testDestroy()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise1 = new \App\Models\Enterprise();
    	$enterprise1->category_id = $category->id;
    	$enterprise1->name = 'Enterprise 1';
    	$enterprise1->contact = 'Contact';
    	$enterprise1->email = 'contact5@enterprise1.com';
    	$enterprise1->site = 'http://www.enterprise1.com';
    	$enterprise1->telephone = '(21)2532-3929';
    	$enterprise1->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise1->status = 'Pending';
    	$enterprise1->password = bcrypt('teste123');
    	$enterprise1->save();

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

    	$enterpriseThanks1 = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks1->user_id = $user1->id;
    	$enterpriseThanks1->enterprise_id = $enterprise1->id;
    	$enterpriseThanks1->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks1->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks1->status = 'Approved';
    	$enterpriseThanks1->save();


    	$enterprise2 = new \App\Models\Enterprise();
    	$enterprise2->category_id = $category->id;
    	$enterprise2->name = 'Enterprise 2';
    	$enterprise2->contact = 'Contact';
    	$enterprise2->email = 'contact6@enterprise2.com';
    	$enterprise2->site = 'http://www.enterprise2.com';
    	$enterprise2->telephone = '(21)2532-9214';
    	$enterprise2->address = 'Av. Rio Branco, 1 - sala 3501';
    	$enterprise2->status = 'Pending';
    	$enterprise2->password = bcrypt('teste123');
    	$enterprise2->save();

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

    	$enterpriseThanks2 = new \App\Models\EnterpriseThanks();
    	$enterpriseThanks2->user_id = $user2->id;
    	$enterpriseThanks2->enterprise_id = $enterprise2->id;
    	$enterpriseThanks2->content = 'Teste de agradecimentos para empresas.';
    	$enterpriseThanks2->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks2->status = 'Approved';
    	$enterpriseThanks2->save();

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('enterprise_thanks', ['deleted_at' => null, 'id' => 1]);
    }
}
