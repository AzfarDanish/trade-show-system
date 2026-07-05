<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    // An exhibitor cannot access admin routes and is redirected.
    public function test_exhibitor_cannot_access_admin()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');

        $response->assertRedirect('/');
    }

    // An admin cannot access exhibitor routes and is redirected.
    public function test_admin_cannot_access_exhibitor()
    {
        $admin = users::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/exhibitor/dashboard');

        $response->assertRedirect('/');
    }

    // A guest is redirected to the login page when accessing protected routes.
    public function test_guest_is_redirected_to_login()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect('/');
    }

    // An exhibitor without a profile is redirected to profile creation.
    public function test_exhibitor_without_profile_is_redirected()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john2@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);

        $response = $this->actingAs($user)->get('/exhibitor/dashboard');

        $response->assertRedirect('/exhibitor/profile/create');
    }
}
