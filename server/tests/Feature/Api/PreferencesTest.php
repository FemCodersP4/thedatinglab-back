<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Preference;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;

class PreferencesTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_preference()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = [
            'birthdate' => '1990-01-01',
            'ageRange' => '20-30',
            'gender' => 'hombre',
            'looksFor' => 'mujeres',
            'values1' => 'honestidad',
            'values2' => 'respeto',
            'values3' => 'responsabilidad',
            'sexoAffective' => 'monogama',
            'heartState' => 'feliz',
            'preferences1' => 'netflix',
            'preferences2' => 'alcohol',
            'catsDogs' => 'gatos',
        ];

        $response = $this->postJson('api/preferences', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['message' => 'Preferencia creada correctamente']);

        $this->assertDatabaseHas('preferences', $data);
    }

    public function test_user_cannot_create_preference_with_invalid_data()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = [
            'birthdate' => '10-10-2015',
        ];

        $response = $this->postJson('api/preferences', $data);

        $response->assertStatus(422)
            ->assertJsonStructure(['validation_errors']);
    }
}
