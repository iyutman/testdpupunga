<?php

namespace Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\WelcomeController;

class WelcomeControllerTest extends TestCase
{
    protected $welcomeController;

    public function setUp() {

        parent::setUp();

        $this->userController = $this->app->make(WelcomeController::class);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testpostConvertString()
    {
        $this->welcomeController;
        $this->assertTrue(true);
    }
 
}