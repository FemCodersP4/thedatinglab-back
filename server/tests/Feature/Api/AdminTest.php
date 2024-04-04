<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\UploadedFile;
use App\Models\Preference;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PreferencesExport;

class AdminTest extends TestCase
{
    use RefreshDatabase;
 
    public function test_Admin_Can_Create_Event()
    {
        $user = User::factory()->create();
        $user->assignRole('admin');

        $this->actingAs($user);

        $fakeImage = UploadedFile::fake()->image('image.jpg');

        $eventData = [
            'title' => 'Evento de prueba',
            'date' => '2024-04-04',
            'time' => '12:00',
            'location'=> 'Ubicación de prueba',
            'shortDescription'=> 'Descripción corta de prueba',
            'description' => 'Descripción larga de prueba',
            'image' => $fakeImage,
        ];

        $response = $this->postJson('/api/admin/event', $eventData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Evento creado exitosamente',
            ]);
    }

    public function test_admin_can_update_event()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $fakeImage = UploadedFile::fake()->image('image.jpg');

        $event = [
            "id"=> '1',
            'title' => 'Evento de prueba',
            'date' => '2024-04-04',
            'time' => '12:00',
            'location'=> 'Ubicación de prueba',
            'shortDescription'=> 'Descripción corta de prueba',
            'description' => 'Descripción larga de prueba',
            'image' => $fakeImage,
        ];

        $updatedEventData = [
            'title' => 'Evento Actualizado',
            'date' => '2024-04-05',
            'time' => '13:00',
            'location'=> 'Nueva Ubicación',
            'shortDescription'=> 'Nueva Descripción Corta',
            'description' => 'Nueva Descripción Larga',
            'image' => $fakeImage,
        ];

        $response = $this->putJson('/api/admin/event/'.$event['id'], $updatedEventData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Evento actualizado exitosamente',
            ]);
    }

    public function test_admin_can_get_all_users()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        User::truncate();

        $users = User::factory(3)->create();

        $response = $this->getJson('/api/admin/users');

        $response->assertStatus(200)
            ->assertJsonCount($users->count());
    }


    public function test_can_get_user_preferences()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $preferences = Preference::factory()->create();
        $user = User::factory()->create(['preference_id' => $preferences->id]);

        $response = $this->getJson('/api/admin/preferences/' . $user->id);

        $response->assertStatus(200)
            ->assertJson($preferences->toArray());
    }


    public function test_returns_message_if_no_preferences_found()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        $user = User::factory()->create();

        $response = $this->getJson('/api/admin/preferences/' . $user->id);

        $response->assertStatus(404)
            ->assertJson(['message' => 'No se encontraron preferencias para el usuario.']);
    }

    public function test_admin_can_export_preferences()
    {
        $admin = User::factory()->create();
        $admin->assignRole('admin');
        $this->actingAs($admin);

        Excel::fake();

        $response = $this->get('/api/admin/export');

        $response->assertStatus(200);
    }
}
