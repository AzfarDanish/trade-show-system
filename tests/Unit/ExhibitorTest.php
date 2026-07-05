<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use App\Models\leads;
use App\Models\appointments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ExhibitorTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(): users
    {
        return users::create([
            'name' => 'John Doe',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
    }

    // An exhibitor can be created and linked to a user.
    public function test_exhibitor_can_be_created()
    {
        $user = $this->makeUser();

        exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John Doe',
            'phone_number' => '555-0100',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('exhibitors', ['company_name' => 'Acme Corp']);
    }

    // Calling joinShow sets the exhibitor status to active.
    public function test_exhibitor_can_join_show()
    {
        $user = $this->makeUser();
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John Doe',
            'phone_number' => '555-0100',
            'status' => 'inactive',
        ]);

        $exhibitor->joinShow();

        $this->assertEquals('active', $exhibitor->fresh()->status);
    }

    // Calling deactivate sets the exhibitor status to inactive.
    public function test_exhibitor_can_be_deactivated()
    {
        $user = $this->makeUser();
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John Doe',
            'phone_number' => '555-0100',
            'status' => 'active',
        ]);

        $exhibitor->deactivate();

        $this->assertEquals('inactive', $exhibitor->fresh()->status);
    }

    // An exhibitor can have multiple leads.
    public function test_exhibitor_has_many_leads()
    {
        $user = $this->makeUser();
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
            'status' => 'active',
        ]);
        leads::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'lead_name' => 'Lead A',
            'company_name' => 'Client Co',
            'phone' => '555-0001',
            'email' => 'a@client.com',
        ]);
        leads::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'lead_name' => 'Lead B',
            'company_name' => 'Client Co',
            'phone' => '555-0002',
            'email' => 'b@client.com',
        ]);

        $this->assertCount(2, $exhibitor->leads);
    }

    // An exhibitor can have multiple appointments.
    public function test_exhibitor_has_many_appointments()
    {
        $user = $this->makeUser();
        $exhibitor = exhibitors::create([
            'user_id' => $user->id,
            'company_name' => 'Acme Corp',
            'representative_name' => 'John',
            'phone_number' => '555-0100',
            'status' => 'active',
        ]);
        appointments::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'client_name' => 'Client A',
            'appointment_date' => '2026-08-10',
            'appointment_time' => '10:00',
            'purpose' => 'Demo',
            'status' => 'Confirmed',
        ]);
        appointments::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'client_name' => 'Client B',
            'appointment_date' => '2026-08-11',
            'appointment_time' => '14:00',
            'purpose' => 'Meeting',
            'status' => 'Pending',
        ]);

        $this->assertCount(2, $exhibitor->appointments);
    }
}
