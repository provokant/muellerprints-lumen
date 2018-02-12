<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    
    use DatabaseMigrations;

    /**
     * Check user authentication.
     *
     * @return void
     */
    public function testAuthentication()
    {
        $user = factory('App\User')->make();

        $this->assertEquals(200, $this->actingAs($user)->call('POST', 'user/info')->status());
    }

    /**
     * Check user login.
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

    /**
     * Get Auth Token after login and open user infos.
     *
     * @return void
     */
    public function testAuthToken()
    {
        $user = factory('App\User')->create();

        $loginResponse = $this->call('POST', 'user/login', [
            'email' => $user->email,
            'password' => 1234567890 // default password for mock users
        ]);

        $token = $loginResponse->original;

        $infoResponse = $this->json('POST', 'user/info', [
            'api_token' => $token
        ])->seeJson([
            'email' => $user->email,
            'name' => $user->name
        ]);
    }
}
