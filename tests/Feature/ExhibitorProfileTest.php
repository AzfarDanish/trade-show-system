<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use App\Models\shows;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ExhibitorProfileTest extends TestCase
{
    use RefreshDatabase;

    // An exhibitor can create their profile.
    public function test_exhibitor_can_create_profile()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);

        $this->actingAs($user)->post('/exhibitor/profile/store', [
            'company_name' => 'My Company',
            'representative_name' => 'Jane Doe',
            'phone_number' => '123-456-7890',
        ]);

        $this->assertDatabaseHas('exhibitors', ['company_name' => 'My Company']);
    }

    // An exhibitor can update their profile details.
    public function test_exhibitor_can_edit_profile()
    {
        $user = users::create([
            'name' => 'Jane',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Original Co',
            'representative_name' => 'Jane',
            'phone_number' => '555-0100',
        ]);

        $this->actingAs($user)->put('/exhibitor/profile/update', [
            'company_name' => 'Updated Co',
            'representative_name' => 'John Smith',
            'phone_number' => '098-765-4321',
        ]);

        $this->assertDatabaseHas('exhibitors', ['company_name' => 'Updated Co']);
    }

    // An exhibitor can join an active show.
    public function test_exhibitor_can_join_show()
    {
        shows::create(['name' => 'Active Show', 'status' => 'active']);
        $user = users::create([
            'name' => 'John',
            'email' => 'john2@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Co',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
            'status' => 'inactive',
        ]);

        $this->actingAs($user)->post('/exhibitor/join');

        $this->assertDatabaseHas('exhibitors', [
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'status' => 'active',
        ]);
    }

    // The exhibitor dashboard loads successfully with stats.
    public function test_dashboard_shows_exhibitor_stats()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john3@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Co',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);

        $response = $this->actingAs($user)->get('/exhibitor/dashboard');

        $response->assertStatus(200);
    }
}
