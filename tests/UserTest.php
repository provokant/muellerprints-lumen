<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Hashing\BcryptHasher;
use App\User;

class UserTest extends TestCase
{
    
    use DatabaseMigrations;

    /**
     * Check user authentication.
     *
     * @return void
     */
    public function testAuth()
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

        $response = $this->userLogin($user);

        $this->assertEquals(200, $response->status());
    }

    /**
     * Login and match User Infos.
     *
     * @return void
     */
    public function testAuthToken()
    {
        $user = factory('App\User')->create();

        $token = $this->userLogin($user)->original;

        $this->json('POST', 'user/info', [
            'api_token' => $token
        ])->seeJson([
            'email' => $user->email,
            'name' => $user->name
        ]);
    }

    /**
     * Fail changing User Password for missmatched old Password.
     *
     * @return void
     */
    public function testFailPasswordUpdateForOldPassword()
    {
        $user = factory('App\User')->create();

        $newPassword = '0987654321';

        $response = $this->actingAs($user)->call('POST', 'user/update/password', [
            'old' => '10293847576',
            'new' => $newPassword,
            'confirmation' => $newPassword
        ]);

        $this->assertEquals(500, $response->status());

        $this->assertFalse((new BcryptHasher)->check($newPassword, User::findOrFail($user->id)->password));
    }

    /**
     * Fail changing User Password for missmatched new Passwords.
     *
     * @return void
     */
    public function testFailPasswordUpdateForNewPasswords()
    {
        $user = factory('App\User')->create();

        $oldPassword = '1234567890';

        $response = $this->actingAs($user)->call('POST', 'user/update/password', [
            'old' => $oldPassword,
            'new' => '1029384756',
            'confirmation' => '0987654321'
        ]);

        $this->assertEquals(500, $response->status());

        $this->assertTrue((new BcryptHasher)->check($oldPassword, User::findOrFail($user->id)->password));
    }

    /**
     * Succeed changing User Password.
     *
     * @return void
     */
    public function testPasswordUpdate()
    {
        $user = factory('App\User')->create();

        $newPassword = '0987654321';

        $response = $this->actingAs($user)->call('POST', 'user/update/password', [
            'old' => '1234567890',
            'new' => $newPassword,
            'confirmation' => $newPassword
        ]);

        $this->assertEquals(200, $response->status());

        $this->assertTrue((new BcryptHasher)->check($newPassword, User::findOrFail($user->id)->password));
    }

    /**
     * Login User and get Response from Login Page.
     * 
     * @return Response
     */

    private function userLogin($user) {
        return $this->call('POST', 'user/login', [
            'email' => $user->email,
            // Default Password for Mock Users
            'password' => '1234567890' 
        ]);
    }
}
