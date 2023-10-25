<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\ChatHistory;
use Illuminate\Support\Facades\Http;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testIndex()
    {
        $this->seed();
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('chatHistory');
    }

    public function testChatGenerator()
    {
        // Mock OpenAI response
        Http::fake([
            '*/completions/*' => Http::response(['choices' => [['text' => 'Mocked AI response']]]),
        ]);

        $this->seed();

        $user = User::factory()->create();

        // No history before the request
        $this->assertCount(0, ChatHistory::all());

        // AI response
        $response = $this->actingAs($user)->post('/dashboard', [
            'chat' => $this->faker->sentence,
        ]);

        // Two history records should be created
        $this->assertCount(2, ChatHistory::all());

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas(['result', 'chatHistory', 'latestChat']);

        // Extract result from view and assert its not empty
        $result = $response->original['result'];

        $this->assertNotEmpty($result);
    }

    public function testSearchHistory()
    {
        $this->seed();

        $user = User::factory()->create();
        $searchTerm = $this->faker->word;

        $response = $this->actingAs($user)->get("/search-history?search={$searchTerm}");

        $response->assertStatus(200);
        $response->assertViewIs('dashboard');
        $response->assertViewHas('chatHistory');
    }
}