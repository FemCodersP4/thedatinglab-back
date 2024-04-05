<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\Register;
use App\Models\Event;
use App\Mail\ConfirmAttendance;
use Database\Factories\UserFactory;
use Database\Factories\EventFactory;

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
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
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

    public function test_attendance_confirmation_sends_email(): void
    {
        Mail::fake();
        $user = User::factory()->create(); 
        $event = Event::factory()->create(); 

    
    $response = $this->actingAs($user)->json('POST', "/api/event/attendance/{$event->id}");

    $response->assertStatus(200)
        ->assertJson([
            'res' => true,
        ]);

        Mail::assertSent(ConfirmAttendance::class, function ($mail) use ($user, $event) {
        return $mail->hasTo($user->email) &&
            $mail->event->id === $event->id;
    });
    }
}
