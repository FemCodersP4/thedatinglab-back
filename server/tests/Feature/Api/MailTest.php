<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\Register;

class MailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_register_sends_email(): void
    {
        Mail::fake();

        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'privacyPolicies' => true,
            'over18' => true,
        ];

        $response = $this->json('POST', '/api/register', $userData);

        $response->assertStatus(201);

        $user = User::where('email', 'john@example.com')->first();

        Mail::assertSent(Register::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }
}
