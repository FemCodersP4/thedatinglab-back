<?php

namespace Tests\Feature\Api;

use App\Http\Controllers\MatchingController;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Preference;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\AssertableJson;

class MatchesTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_get_matches()
    {

        $response = $this->getJson('api/matching-users');


        $response->assertStatus(401);
    }


    public function test_user_cannot_get_matches_without_preference()
    {

        $user = User::create([
            "name" => "Jane Doe",
            "email" => "jane@example.com",
            "password" => Hash::make("password"),
        ]);


        Sanctum::actingAs($user);

        $response = $this->getJson('/api/matching-users');

        $response->assertStatus(404);
        $response->assertJson(['msg' => 'Necesitas rellenar el test de compatibilidad para poder ver tus matches.']);
    }

    public function test_user_cannot_get_empty_matches()
    {

        $user = User::factory()->create([
            "name" => "Alice Doe",
            "email" => "alice@example.com",
            "password" => Hash::make("password"),
        ]);


        $preference = [
            'birthdate' => '1990-01-01',
            'gender' => 'hombre',
            'looksFor' => 'mujer',
            'ageRange' => '25-35',
            'sexoAffective' => 'monogama',
            'heartState' => 'maduro',
            'hasChildren' => 'no',
            'datesParents' => 'no',
            'values1' => 'amabilidad',
            'values2' => 'diversion',
            'values3' => 'lealtad',
            'prefers1' => 'netflix',
            'prefers2' => 'vino',
            'catsDogs' => 'perro',
            'rrss' =>'asdfds',
        ];


        $user->preference()->create($preference);


        Sanctum::actingAs($user);


        $response = $this->getJson('api/matching-users');

        $response->assertStatus(404);
    }


}
