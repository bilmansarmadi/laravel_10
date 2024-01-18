<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegisterSuccsess()
    {
        $this->post('api/users/register',[
            'users_name' => 'Hamdan',
            'users_email' => 'Hamdan@example.com',
            'balance' =>    '100',
            'location'=>'32322',
            'users_password'=>'32322'
        ])->assertStatus(201)->assertJson([
            'code' => 200,
            'success' => true,
            'data' => [
                'users_name' => 'Hamdan',
                'users_email' => 'Hamdan@example.com',
                'balance' =>    '100',
                'location'=>'32322'
            ],
            'error' => null,
        ]);
    }

    public function testRegisterFailed()
    {

        $this->post('api/users/register',[
            'users_name' => '',
            'users_email' => '',
            'balance' =>    '',
            'location'=>'',
            'users_password'=>''
        ])->assertStatus(400)->assertJson([
            "code" =>   "400",
            "status" => "false",
            "data" => [],
            "error" => [
                'users_name' => ['The users name field is required.'],
                'users_email' => ['The users email field is required.'],
                'users_password' => ['The users password field is required.'],
                'balance' => ['The balance field is required.'],
                'location'=> ['The location field is required.']
            ]
        ]);

    }

    public function testRegisterAllredy()
    {
        $this->post('api/users/register',[
            'users_name' => 'Hamdan',
            'users_email' => 'Hamdan@example.com',
            'balance' =>    '100',
            'location'=>'32322',
            'users_password'=>'32322'
        ])->assertStatus(400)->assertJson([
            "code" =>   "400",
            "status" => "false",
            "data" => [],
            "error" => [
                'users_name' => ["users already registered"]
            ]
        ]);

    }

    public function testLoginSuccsess()
    {
        $this->post('api/users/login',[
            'users_email' => 'Hamdan@example.com',
            'users_password'=>'32322'
        ])->assertStatus(200)->assertJson([
            'code' => "200",
            'success' => true,
            "data" => [
                'users_id' => 13,
                'users_name' => 'Hamdan',
                'users_email' => 'Hamdan@example.com',
                'location' => '32322',
                'balance' => 100
            ],
            'error' => null
        ]);

        $user = User::where('users_email', 'Hamdan@example.com')->first();
        self::assertNotNull($user->users_token);
    }

    public function testLoginFailedNotFound()
    {
        $this->post('api/users/login',[
            'users_email' => 'Hamdan@examplee.com',
            'users_password'=>'32322'
        ])->assertStatus(401)->assertJson([
            "code" => 401,
            "success" => false,
            "data" => null,
            "error" => [
                "users_email" => ["Invalid email or password"],
            ]
        ]);

        $user = User::where('users_email', 'Hamdan@example.com')->first();
        self::assertNotNull($user->users_token);
    }

    public function testLoginFailedPasswordWrong()
    {
        $this->post('api/users/login',[
            'users_email' => 'Hamdan@examplee.com',
            'users_password'=>'323223'
        ])->assertStatus(401)->assertJson([
            "code" => 401,
            "success" => false,
            "data" => null,
            "error" => [
                "users_email" => ["Invalid email or password"],
            ]
        ]);

        $user = User::where('users_email', 'Hamdan@example.com')->first();
        self::assertNotNull($user->users_token);
    }

    public function testGetSuccess(){
        $this->get('api/users/get', [
            'Authorization' => '62ec394e-225c-4fdf-8e90-1d92b92ef8fa'
        ])->assertStatus(200)
          ->assertJson([
            'code' => 200,
            'success' => true,
              "data" => [
                'users_id' => 14,
                'users_name' => 'Hamdan',
                'users_email' => 'Hamdan@example.com',
                'location' => '32322',
                'balance' => 100
              ],
              "error" => null
          ]);
    }


    public function testGetUnauthorized(){
        $this->get('api/users/get', [
            'Authorization' => ''
        ])->assertStatus(401)
          ->assertJson([
            "code" => 401,
            "success" => false,
            "data" => null,
            "error" => [
                "message" => ["unauthorized"]
            ]
          ]);
    }

    public function testGetInvalidToken(){
        $this->get('api/users/get', [
            'Authorization' => '08b86d49-8437-4622-9568-b22ff18df5caque'
        ])->assertStatus(401)
          ->assertJson([
            "code" => 401,
            "success" => false,
            "data" => null,
            "error" => [
                "message" => ["invalid token"]
            ]
          ]);
    }

}
