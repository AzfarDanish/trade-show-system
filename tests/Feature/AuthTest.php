<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    // A user can register and is assigned the exhibitor role.
    public function test_user_can_register()
    {
        $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'role' => 'exhibitor',
        ]);
    }

    // An admin is redirected to the admin dashboard after login.
    public function test_admin_can_login()
    {
        users::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $response = $this->post('/', [
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin/dashboard');
    }

    // An exhibitor with a profile is redirected to the exhibitor dashboard.
    public function test_exhibitor_can_login()
    {
        $user = users::create([
            'name' => 'Exhibitor',
            'email' => 'exhibitor@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);

        $response = $this->post('/', [
            'email' => 'exhibitor@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/exhibitor/dashboard');
    }

    // Login with invalid credentials returns an error message.
    public function test_login_fails_with_invalid_credentials()
    {
        $response = $this->post('/', [
            'email' => 'wrong@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('email');
    }

    // A logged-in user can log out and becomes a guest.
    public function test_user_can_logout()
    {
        $user = users::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);

        $this->actingAs($user)->post('/logout');

        $this->assertGuest();
    }
}
