<?php

namespace Tests\Feature\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SiteControllerTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    use WithoutMiddleware;

    /**
     * Testing about method
     *
     * @return void
     */
    public function testAbout()
    {
    	$response = $this->get('/quem-somos');
        $response->assertStatus(200);
    }

    /**
     * Testing contact method
     *
     * @return void
     */
    public function testContact()
    {
    	$response = $this->get('/contato');
        $response->assertStatus(200);
    }

    /**
     * Testing support method
     *
     * @return void
     */
    public function testSupport()
    {
    	$response = $this->get('/apoiadores');
        $response->assertStatus(200);
    }

    /**
     * Testing loginWithData method
     *
     * @return void
     */
    /*public function testLoginWithData()
    {
        @todo Implement test	
    }*

	/**
     * Testing sendMessageContactForm method
     *
     * @return void
     */
    /*public function testSendMessageContactForm()
    {
    	@todo Implement test
    }*/
}
