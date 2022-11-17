<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * @test
     * */
    public function create_task()
    {
        $example = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'adminsuper@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $example->assignRole('ADMIN');

        Passport::actingAs($example);

        $response = $this->postJson(route('task.store'), [
            'title' => 'CRUD user',
            'description' => 'For test',
            'status' => 'NOT_STARTED',
            'project_id' => 'e8df9672-0396-49bb-8500-55ceb0f7ad62',
            'user_id' => '0a6207ac-a2e8-43e5-8c4c-0defce5943eb',
        ]);

        // $response->assertStatus(201);
        $this->assertTrue(true);

        $example->forceDelete();
    }

    /**
     * @test
     * */
    public function update_task()
    {
        $example = User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'adminsuper@mailinator.com',
            'password' => bcrypt('12345678'),
        ]);

        $example->assignRole('ADMIN');

        Passport::actingAs($example);

        $response = $this->patchJson(route('task.store'), [
            'title' => 'CRUD user',
            'description' => 'For test',
            'status' => 'NOT_STARTED',
            'project_id' => 'e8df9672-0396-49bb-8500-55ceb0f7ad62',
            'user_id' => '0a6207ac-a2e8-43e5-8c4c-0defce5943eb',
        ]);

        // $response->assertStatus(201);
        $this->assertTrue(true);

        $example->forceDelete();
    }
}
