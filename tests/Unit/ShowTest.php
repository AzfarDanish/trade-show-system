<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\shows;
use App\Models\booths;
use App\Models\exhibitors;
use App\Models\users;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    // An active show can be created and stored in the database.
    public function test_show_can_be_created()
    {
        shows::create([
            'name' => 'Tech Expo 2026',
            'status' => 'active',
        ]);

        $this->assertDatabaseHas('shows', ['name' => 'Tech Expo 2026']);
    }

    // activeShow returns null when no show has status active.
    public function test_active_show_returns_null_when_none()
    {
        $this->assertNull(shows::activeShow());
    }

    // Calling end sets status to ended and records the end date.
    public function test_show_can_be_ended()
    {
        $show = shows::create([
            'name' => 'Test Show',
            'status' => 'active',
        ]);

        $show->end();

        $this->assertDatabaseHas('shows', [
            'show_id' => $show->show_id,
            'status' => 'ended',
        ]);
    }

    // A show can have multiple booths assigned to it.
    public function test_show_has_many_booths()
    {
        $user = users::create(['name' => 'J', 'email' => 'j@j.com', 'password' => Hash::make('p'), 'role' => 'exhibitor']);
        $exhibitor = exhibitors::create(['user_id' => $user->id, 'company_name' => 'C', 'representative_name' => 'R', 'phone_number' => '555-0100']);
        $show = shows::create(['name' => 'Test Show', 'status' => 'active']);
        booths::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'show_id' => $show->show_id,
            'booth_number' => 'B101',
            'location' => 'Hall A',
        ]);
        booths::create([
            'exhibitor_id' => $exhibitor->exhibitor_id,
            'show_id' => $show->show_id,
            'booth_number' => 'B102',
            'location' => 'Hall B',
        ]);

        $this->assertCount(2, $show->booths);
    }
}
