<?php

namespace Tests\Feature\Dashboard;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ACLTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_admin_can_access_dashboard()
    {
        $admin = new Admin();
        $admin->name = 'Test Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();

        $response = $this->actingAs($admin, 'dashboard')
            ->get('/dashboard');

        $response->assertStatus(200);
    }

    /** @test */
    public function unauthenticated_user_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect('/dashboard/login');
    }
}