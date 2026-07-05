<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use App\Models\leads;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class LeadTest extends TestCase
{
    use RefreshDatabase;

    // An exhibitor can create a lead and it appears in the database.
    public function test_lead_can_be_created()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Inc',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);

        $this->actingAs($user)->post('/exhibitor/leads/store', [
            'lead_name' => 'John Doe',
            'company_name' => 'Acme Inc',
            'phone' => '555-0100',
            'email' => 'john@acme.com',
        ]);

        $this->assertDatabaseHas('leads', ['lead_name' => 'John Doe']);
    }

    // An exhibitor can update their own lead.
    public function test_lead_can_be_updated()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john2@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Inc',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);
        $lead = leads::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'lead_name' => 'Old Name',
            'company_name' => 'Old Co',
            'phone' => '555-0001',
            'email' => 'old@co.com',
        ]);

        $this->actingAs($user)->put("/exhibitor/leads/update/{$lead->lead_id}", [
            'lead_name' => 'Jane Doe',
            'company_name' => 'Acme Inc',
            'phone' => '555-0200',
            'email' => 'jane@acme.com',
        ]);

        $this->assertDatabaseHas('leads', ['lead_name' => 'Jane Doe']);
    }

    // An exhibitor can delete their own lead.
    public function test_lead_can_be_deleted()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john3@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Inc',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);
        $lead = leads::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'lead_name' => 'Delete Me',
            'company_name' => 'Co',
            'phone' => '555-0001',
            'email' => 'del@co.com',
        ]);

        $this->actingAs($user)->delete("/exhibitor/leads/delete/{$lead->lead_id}");

        $this->assertDatabaseMissing('leads', ['lead_id' => $lead->lead_id]);
    }

    // An exhibitor cannot edit a lead owned by another exhibitor.
    public function test_cannot_edit_other_exhibitors_lead()
    {
        $user = users::create([
            'name' => 'John',
            'email' => 'john4@example.com',
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Inc',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
        ]);
        $otherUser = users::create([
            'name' => 'Bob', 'email' => 'bob@example.com',
            'password' => Hash::make('password'), 'role' => 'exhibitor',
        ]);
        $other = exhibitors::create([
            'user_id' => $otherUser->id,
            'company_name' => 'Other Co',
            'representative_name' => 'Bob',
            'phone_number' => '555-0200',
        ]);
        $lead = leads::create([
            'exhibitor_id' => $other->exhibitor_id,
            'lead_name' => 'Not Mine',
            'company_name' => 'Co',
            'phone' => '555-0001',
            'email' => 'not@mine.com',
        ]);

        $response = $this->actingAs($user)->get("/exhibitor/leads/edit/{$lead->lead_id}");

        $response->assertNotFound();
    }
}
