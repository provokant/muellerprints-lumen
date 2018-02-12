<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    
    use DatabaseMigrations;

    /**
     * Check user authentication
     *
     * @return void
     */
    public function testAuthentication()
    {
        $user = factory('App\User')->make();

        $this->assertEquals(200, $this->actingAs($user)->call('POST', 'user/info')->status());
    }

    /**
     * Check user login
     *
     * @return void
     */
    public function testLogin()
    {
        $user = factory('App\User')->create();

        $response = $this->call('POST', 'user/login', [
            'email' => $user->email,
            'password' => 1234567890 // default password for mock users
        ]);

        $this->assertEquals(200, $response->status());
    }
}
