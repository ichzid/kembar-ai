<?php

namespace Tests\Feature;

use App\Models\Persona;
use App\Models\User;
use App\Models\WhatsappAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QiscusIntegrationTest extends TestCase
{ 
    use RefreshDatabase;

    public function test_can_resolve_persona_by_qiscus_app_code()
    {
        // 1. Setup Data
        // Manually create user to avoid UserFactory password issue (schema has no password column)
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@example.com';
        $user->save();

        $persona = Persona::create([
            'user_id' => $user->id,
            'persona_name' => 'Test Bot',
            'persona_description' => 'You are a helpful assistant.',
            'role_summary' => 'Help users.',
            'default_language' => 'id',
        ]);

        $account = WhatsappAccount::create([
            'user_id' => $user->id,
            'persona_id' => $persona->id,
            'provider' => 'qiscus',
            'provider_app_id' => 'test_app_code_123',
            'phone_number' => '6281234567890',
            'status' => 'connected',
        ]);

        // 2. Call Endpoint
        $response = $this->postJson('/api/integrations/qiscus/resolve', [
            'app_code' => 'test_app_code_123',
            'sender_number' => '628987654321', // User phone
            'name' => 'Test User',
        ]);

        // 3. Assertions
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'persona' => [
                        'id' => $persona->id,
                        'name' => 'Test Bot',
                    ],
                    'lead' => [
                        'phone' => '628987654321',
                        'name' => 'Test User',
                    ]
                ]
            ]);
            
        // Assert Lead was created
        $this->assertDatabaseHas('leads', [
            'phone' => '628987654321',
            'persona_id' => $persona->id,
            'name' => 'Test User',
        ]);
    }

    public function test_can_resolve_persona_by_bot_phone()
    {
        // 1. Setup Data
        $user = new User();
        $user->name = 'Test User 2';
        $user->email = 'test2@example.com';
        $user->save();

        $persona = Persona::create([
            'user_id' => $user->id,
            'persona_name' => 'Bot Phone Test',
            'persona_description' => 'Bot Phone Description',
            'role_summary' => 'Summary',
            'default_language' => 'en',
        ]);

        WhatsappAccount::create([
            'user_id' => $user->id,
            'persona_id' => $persona->id,
            'provider' => 'qiscus',
            'provider_app_id' => 'some_other_code',
            'phone_number' => '628111222333',
            'status' => 'connected',
        ]);

        // 2. Call Endpoint with bot_phone only
        $response = $this->postJson('/api/integrations/qiscus/resolve', [
            'bot_phone' => '628111222333',
            'sender_number' => '628555666777',
            'name' => 'Phone User',
        ]);

        // 3. Assertions
        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'persona' => [
                        'id' => $persona->id,
                    ]
                ]
            ]);
    }

    public function test_returns_404_if_app_code_not_found()
    {
        $response = $this->postJson('/api/integrations/qiscus/resolve', [
            'app_code' => 'invalid_code',
            'sender_number' => '628987654321',
        ]);

        $response->assertStatus(404);
    }
}
