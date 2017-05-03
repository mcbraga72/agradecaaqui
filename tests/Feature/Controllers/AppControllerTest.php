<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Hash;

class AppControllerTest extends TestCase
{
    use DatabaseMigrations;
	use DatabaseTransactions;
	use WithoutMiddleware;

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
    public function testUpdateAvatar()
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
     * Testing storeEnterprise method
     *
     * @return void
     */
    public function testStoreEnterprise()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise Store';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

    	$this->assertDatabaseHas('enterprises', ['name' => 'Enterprise Store']);
    }

    /**
     * Testing findEnterprise method
     *
     * @return void
     */
    public function testFindEnterprise()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

    	$enterprises = \App\Models\Enterprise::where('name', 'LIKE', '%Ent%')->orderBy('name', 'asc')->get();

    	$this->assertTrue($enterprises->contains('name', 'Enterprise'));
    }

    /**
     * Testing findThanks method
     *
     * @return void
     */
    public function testFindThanks()
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

    	$this->assertDatabaseHas('user_thanks', ['content' => 'Teste de agradecimentos para usuários.']);


    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise = new \App\Models\Enterprise();
    	$enterprise->category_id = $category->id;
    	$enterprise->name = 'Enterprise';
    	$enterprise->contact = 'Contact';
    	$enterprise->email = 'contact1@enterprise.com';
    	$enterprise->site = 'http://www.enterprise.com';
    	$enterprise->telephone = '(21)2532-3929';
    	$enterprise->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise->status = 'Pending';
    	$enterprise->password = bcrypt('teste123');
    	$enterprise->save();

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
     * Testing getCategories method
     *
     * @return void
     */
    public function testGetCategories()
    {
    	$category1 = new \App\Models\Category();
    	$category1->name = 'Category 1';
    	$category1->save();

    	$category2 = new \App\Models\Category();
    	$category2->name = 'Category 2';
    	$category2->save();

    	$categories = \App\Models\Category::all();

    	$this->assertTrue($categories->contains('name', 'Category 1'));
    	$this->assertTrue($categories->contains('name', 'Category 2'));
    }

    /**
     * Testing getEnterprises method
     *
     * @return void
     */
    public function testGetEnterprises()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category 1';
    	$category->save();

    	$enterprise1 = new \App\Models\Enterprise();
    	$enterprise1->category_id = $category->id;
    	$enterprise1->name = 'Enterprise 1';
    	$enterprise1->contact = 'Contact';
    	$enterprise1->email = 'contact@enterprise1.com';
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
    	$enterprise2->email = 'contact@enterprise2.com';
    	$enterprise2->site = 'http://www.enterprise2.com';
    	$enterprise2->telephone = '(21)2532-3929';
    	$enterprise2->address = 'Av. Rio Branco, 1 - sala 2301';
    	$enterprise2->status = 'Pending';
    	$enterprise2->password = bcrypt('teste123');
    	$enterprise2->save();

    	$enterprises = \App\Models\Enterprise::all();

    	$this->assertTrue($enterprises->contains('name', 'Enterprise 1'));
    	$this->assertTrue($enterprises->contains('name', 'Enterprise 2'));
    }
}
