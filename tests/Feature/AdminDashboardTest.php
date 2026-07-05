<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\users;
use App\Models\shows;
use App\Models\exhibitors;
use App\Models\booths;
use App\Models\leads;
use App\Models\appointments;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): users
    {
        return users::create([
            'name' => 'Admin',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }

    private function makeUser(): users
    {
        return users::create([
            'name' => 'User',
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => 'exhibitor',
        ]);
    }

    private function makeExhibitor(): exhibitors
    {
        return exhibitors::create([
            'user_id' => $this->makeUser()->id,
            'company_name' => fake()->company(),
            'representative_name' => fake()->name(),
            'phone_number' => fake()->phoneNumber(),
            'status' => 'active',
        ]);
    }

    // An admin can create a new show.
    public function test_show_can_be_created_by_admin()
    {
        $this->actingAs($this->admin())->post('/admin/shows/store', [
            'name' => 'Trade Show 2026',
        ]);

        $this->assertDatabaseHas('shows', ['name' => 'Trade Show 2026']);
    }

    // Ending a show deletes its booths and deactivates exhibitors.
    public function test_show_can_be_ended_by_admin()
    {
        $admin = $this->admin();
        $exhibitor = $this->makeExhibitor();
        $show = shows::create(['name' => 'Show', 'status' => 'active']);
        booths::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'show_id' => $show->show_id,
            'booth_number' => 'B101',
            'location' => 'Hall A',
        ]);

        $this->actingAs($admin)->post('/admin/shows/end');

        $this->assertDatabaseHas('shows', ['show_id' => $show->show_id, 'status' => 'ended']);
        $this->assertDatabaseMissing('booths', ['show_id' => $show->show_id]);
        $this->assertDatabaseHas('exhibitors', ['exhibitor_id' => $exhibitor->exhibitor_id, 'status' => 'inactive']);
    }

    // An admin can assign a booth to an exhibitor during an active show.
    public function test_booth_can_be_assigned()
    {
        $admin = $this->admin();
        shows::create(['name' => 'Active Show', 'status' => 'active']);
        $exhibitor = $this->makeExhibitor();

        $this->actingAs($admin)->post('/admin/booths/store', [
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'booth_number' => 'B101',
            'location' => 'Hall A',
        ]);

        $this->assertDatabaseHas('booths', ['booth_number' => 'B101']);
    }

    // An admin can search exhibitors by company or representative name.
    public function test_exhibitors_can_be_searched()
    {
        $admin = $this->admin();
        $u1 = $this->makeUser();
        $u2 = $this->makeUser();
        exhibitors::create([
            'user_id' => $u1->id, 'company_name' => 'Alpha Corp',
            'representative_name' => 'A', 'phone_number' => '555-0100',
        ]);
        exhibitors::create([
            'user_id' => $u2->id, 'company_name' => 'Beta Inc',
            'representative_name' => 'B', 'phone_number' => '555-0200',
        ]);

        $response = $this->actingAs($admin)->get('/admin/exhibitors/search?search=Alpha');

        $this->assertCount(1, $response->viewData('exhibitors'));
    }

    // An admin can search leads by name or company.
    public function test_leads_can_be_searched()
    {
        $admin = $this->admin();
        $e1 = $this->makeExhibitor();
        $e2 = $this->makeExhibitor();
        leads::create([
            'exhibitor_id' => $e1->exhibitor_id, 'lead_name' => 'Alice',
            'company_name' => 'Co', 'phone' => '555-0001', 'email' => 'a@c.com',
        ]);
        leads::create([
            'exhibitor_id' => $e2->exhibitor_id, 'lead_name' => 'Bob',
            'company_name' => 'Co', 'phone' => '555-0002', 'email' => 'b@c.com',
        ]);

        $response = $this->actingAs($admin)->get('/admin/leads/search?search=Alice');

        $this->assertCount(1, $response->viewData('leads'));
    }

    // An admin can filter appointments by status.
    public function test_appointments_can_be_filtered()
    {
        $admin = $this->admin();
        $e1 = $this->makeExhibitor();
        $e2 = $this->makeExhibitor();
        appointments::create([
            'exhibitor_id' => $e1->exhibitor_id, 'client_name' => 'C1',
            'appointment_date' => '2026-08-01', 'appointment_time' => '10:00',
            'purpose' => 'Demo', 'status' => 'Confirmed',
        ]);
        appointments::create([
            'exhibitor_id' => $e2->exhibitor_id, 'client_name' => 'C2',
            'appointment_date' => '2026-08-02', 'appointment_time' => '11:00',
            'purpose' => 'Meeting', 'status' => 'Pending',
        ]);

        $response = $this->actingAs($admin)->get('/admin/appointments/filter?status=Confirmed');

        $this->assertCount(1, $response->viewData('appointments'));
    }

    // A guest cannot create a show and is redirected to login.
    public function test_show_cannot_be_created_by_guest()
    {
        $response = $this->post('/admin/shows/store', ['name' => 'Hack']);

        $response->assertRedirect('/');
    }
}
