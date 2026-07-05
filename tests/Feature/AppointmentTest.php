<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\exhibitors;
use App\Models\appointments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    // An exhibitor can create an appointment with Confirmed status.
    public function test_appointment_can_be_created()
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

        $this->actingAs($user)->post('/exhibitor/appointments/store', [
            'client_name' => 'Client Alpha',
            'appointment_date' => '2026-08-10',
            'appointment_time' => '14:30',
            'purpose' => 'Product demo',
        ]);

        $this->assertDatabaseHas('appointments', ['client_name' => 'Client Alpha']);
    }

    // An exhibitor can update their own appointment including status.
    public function test_appointment_can_be_updated()
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
        $appointment = appointments::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'client_name' => 'Old Client',
            'appointment_date' => '2026-08-01',
            'appointment_time' => '10:00',
            'purpose' => 'Old meeting',
            'status' => 'Confirmed',
        ]);

        $this->actingAs($user)->put("/exhibitor/appointments/update/{$appointment->appointment_id}", [
            'client_name' => 'Updated Client',
            'appointment_date' => '2026-08-15',
            'appointment_time' => '10:00',
            'purpose' => 'Contract signing',
            'status' => 'Completed',
        ]);

        $this->assertDatabaseHas('appointments', ['client_name' => 'Updated Client']);
    }

    // An exhibitor can delete their own appointment.
    public function test_appointment_can_be_deleted()
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
        $appointment = appointments::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'client_name' => 'Delete Me',
            'appointment_date' => '2026-08-01',
            'appointment_time' => '10:00',
            'purpose' => 'Delete',
            'status' => 'Confirmed',
        ]);

        $this->actingAs($user)->delete("/exhibitor/appointments/delete/{$appointment->appointment_id}");

        $this->assertDatabaseMissing('appointments', ['appointment_id' => $appointment->appointment_id]);
    }

    // An exhibitor cannot edit an appointment owned by another exhibitor.
    public function test_cannot_edit_other_exhibitors_appointment()
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
        $appointment = appointments::create([
            'exhibitor_id' => $other->exhibitor_id,
            'client_name' => 'Not Mine',
            'appointment_date' => '2026-08-01',
            'appointment_time' => '10:00',
            'purpose' => 'Not mine',
            'status' => 'Confirmed',
        ]);

        $response = $this->actingAs($user)->get("/exhibitor/appointments/edit/{$appointment->appointment_id}");

        $response->assertNotFound();
    }
}
