<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManageUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_cannot_access_user()
    {
        $response = $this->get('/user');
        $response->assertStatus(403);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_user_list()
    {
        $response =  $this->get('/user/list/0');
        $response->assertStatus(403);
    }

    /** @test */
    public function authenticated_non_admin_user_cant_get_users() 
    {
        $this->actingAs(factory(User::class)->create());
        $response = $this->get('/user');
        $response->assertStatus(403);
    }
}
