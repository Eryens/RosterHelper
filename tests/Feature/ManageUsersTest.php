<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class ManageUsersTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function unauthenticated_user_cannot_access_user()
    {
        $response = $this->get('/user');
        $response->assertStatus(403);

        $response =  $this->get('/user/list/0');
        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_non_admin_user_cant_get_users() 
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/user');
        $response->assertStatus(403);

        $response = $this->get('/user/list/0');
        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_admin_can_see_user_pages()
    {
        $user = factory(User::class)->create();
        $user->assignRole('admin');
        $this->actingAs($user);
        
        $response = $this->get('/user/list/0');
        $response->assertStatus(200);

        $response = $this->get('/user');
        $response->assertStatus(200);
    }
}
