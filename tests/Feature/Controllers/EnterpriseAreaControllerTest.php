<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Hash;

class EnterpriseAreaControllerTest extends TestCase
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
    	$response = $this->get('/admin/empresas/listar');
        $response->assertStatus(200);    	
    }

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

    	$this->assertDatabaseHas('enterprises', ['name' => 'Enterprise Store']);    	
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

    	$enterprise::findOrFail(1);
    	$name = $enterprise->name;

    	$this->assertEquals('Enterprise Show', $name);    	
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

    	$enterprise::findOrFail(1);
    	$enterprise->name = 'New Enterprise';
    	$enterprise->save();

    	$this->assertEquals('New Enterprise', $enterprise->name);
    }

    /**
     * Testing changePassword method
     *
     * @return void
     */
    public function testChangePassword()
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

    	$user = \App\Models\User::findOrFail(1);
    	$user->password = bcrypt('teste');
    	$user->save();

    	$this->assertEquals(true, Hash::check('teste', $user->password));
    }

    /**
     * Testing updateAvatar method
     *
     * @return void
     */
    public function testUpdateLogo()
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
    	$user->photo = 'images/user2.jpg';
    	$user->password = bcrypt('teste123');
    	$user->save();

    	$user = \App\Models\User::findOrFail(1);
    	$user->photo = 'images/user2.png';
    	$user->save();

    	$this->assertEquals('images/user2.png', $user->photo);
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

    	$enterprise = \App\Models\Enterprise::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('enterprises', ['deleted_at' => null, 'id' => 1]);
    }

    /**
     * Testing replica method
     *
     * @return void
     */
    public function testReplica()
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
    	$enterpriseThanks->replica = 'Resposta ao agradecimento.';
    	$enterpriseThanks->thanksDateTime = '2017-05-03 10:21:21';
    	$enterpriseThanks->status = 'Approved';
    	$enterpriseThanks->save();

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1);

        $this->assertEquals('Resposta ao agradecimento.', $enterpriseThanks->replica);
    }

    /**
     * Testing storeReplica method
     *
     * @return void
     */
    public function testStoreReplica()
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

    	$enterpriseThanks = \App\Models\EnterpriseThanks::findOrFail(1);
    	$enterpriseThanks->replica = 'Resposta ao agradecimento.';
		$enterpriseThanks->save();    	

    	$this->assertDatabaseHas('enterprise_thanks', ['replica' => 'Resposta ao agradecimento.']);
    }    
}
