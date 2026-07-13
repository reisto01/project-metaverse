<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_pages_require_an_admin_account(): void
    {
        $this->get('/adminpage')->assertRedirect('/login');

        $member = User::factory()->create(['role_id' => 2, 'is_deleted' => 1]);
        $this->actingAs($member)->get('/adminpage')->assertForbidden();

        $admin = User::factory()->create(['role_id' => 1, 'is_deleted' => 1]);
        $this->actingAs($admin)->get('/adminpage')->assertOk();
    }

    public function test_profile_updates_ignore_a_submitted_user_id(): void
    {
        $member = User::factory()->create([
            'username' => 'member',
            'email' => 'member@example.test',
            'role_id' => 2,
            'is_deleted' => 1,
        ]);
        $other = User::factory()->create([
            'username' => 'other',
            'email' => 'other@example.test',
            'role_id' => 1,
            'is_deleted' => 1,
        ]);

        $this->actingAs($member)->post('/updateAccountUser', [
            'id' => $other->id,
            'name_register' => 'Updated Member',
            'username_register' => 'updated-member',
            'email_register' => 'updated@example.test',
        ])->assertRedirect('/profile');

        $this->assertDatabaseHas('users', ['id' => $member->id, 'username' => 'updated-member']);
        $this->assertDatabaseHas('users', ['id' => $other->id, 'username' => 'other']);
    }
}
