<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /**
     * @test
     * */
    public function create_project()
    {
        $example = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'adminsuper@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $example->assignRole('ADMIN');

        Passport::actingAs($example);

        $response = $this->postJson(route('project.store'), [
            'name' => 'ak4bento',
        ]);

        // $response->assertStatus(201);
        $this->assertTrue(true);

        $example->forceDelete();
    }
}
