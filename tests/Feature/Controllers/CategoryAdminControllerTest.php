<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryAdminControllerTest extends TestCase
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
    	$response = $this->get('/admin/categorias/listar');
        $response->assertStatus(200);    	
    }

    /**
     * Testing index method
     *
     * @return void
     */
    public function testIndex()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Category';
    	$category->save();

    	$this->call('GET', '/admin/categorias')
    		 ->assertJsonStructure([
    		 		'pagination' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'from', 'to'
    		 		],
    		 		'data' => [
    		 			'total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url', 'from', 'to', 'data' => [
    		 				0 => [
    		 					'id', 'name', 'created_at', 'updated_at', 'deleted_at'
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
    	$category = new \App\Models\Category();
    	$category->name = 'Store Category';
    	$category->save();

    	$this->assertDatabaseHas('categories', ['name' => 'Store Category']);    	
    }

    /**
     * Testing show method
     *
     * @return void
     */
    public function testShow()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Show Category';
    	$category->save();

    	$category::findOrFail(1);
    	$name = $category->name;

    	$this->assertEquals('Show Category', $name);    	
    }

    /**
     * Testing update method
     *
     * @return void
     */
    public function testUpdate()
    {
    	$category = new \App\Models\Category();
    	$category->name = 'Update Category';
    	$category->save();

    	$category::findOrFail(1);
    	$category->name = 'New Category';
    	$category->save();

    	$this->assertEquals('New Category', $category->name);
    }

    /**
     * Testing destroy method
     *
     * @return void
     */
    public function testDestroy()
    {
    	$category1 = new \App\Models\Category();
    	$category1->name = 'Category 1';
    	$category1->save();

    	$category2 = new \App\Models\Category();
    	$category2->name = 'Category 2';
    	$category2->save();

    	$category = \App\Models\Category::findOrFail(1)->delete();

    	$this->assertDatabaseMissing('categories', ['deleted_at' => null, 'id' => 1]);
    }
}
