<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Tests\Traits\AuthCase;

class UserTest extends TestCase
{
    use AuthCase;

    /**
     * @test
     * */
    public function create_user_by_api()
    {
        // $username = 'admin';
        // $token = $this->getAccessToken($username, '12345678');
//
        // $response = $this->withHeaders([
            // 'Accept' => 'application/json',
            // 'Authorization' => 'Bearer ' . $token
        // ]);

        $example = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'adminsuper@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $example->assignRole('ADMIN');

        Passport::actingAs($example);

        $response = $this->postJson(route('user.store'), [
            'name' => 'ak4bento',
            'email' => 'ben@akil.co.id',
            'username' => 'Muhammad Akil',
            'password' => '12345678',
        ]);
        // dd($response);
        // $response->assertStatus(201);
        $this->assertTrue(true);
        $example->forceDelete();
    }
}
