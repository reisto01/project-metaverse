<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_registration_always_creates_a_regular_user(): void
    {
        $response = $this->post('/register', [
            'name' => 'New User',
            'username' => 'new-user',
            'email' => 'new@example.test',
            'password' => 'strong-password',
            'role' => 1,
        ]);

        $response->assertRedirect('/login');
        $user = User::where('email', 'new@example.test')->firstOrFail();
        $this->assertSame(2, $user->role_id);
        $this->assertTrue(Hash::check('strong-password', $user->password));
    }

    public function test_login_regenerates_authentication_and_redirects_by_role(): void
    {
        $user = User::factory()->create([
            'username' => 'member',
            'password' => Hash::make('strong-password'),
            'role_id' => 2,
            'is_deleted' => 1,
        ]);

        $this->post('/login', [
            'username_login' => 'member',
            'password_login' => 'strong-password',
        ])->assertRedirect('/');

        $this->assertAuthenticatedAs($user);
    }
}
