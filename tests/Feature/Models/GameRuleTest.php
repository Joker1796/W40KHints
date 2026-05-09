<?php

namespace Feature\Models;

use App\Models\GameRule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameRuleTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test game rule',
        'description' => 'test description',
        'comment' => 'test comment',
        'text' => 'test text with <b>html</b>',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test game rule updated',
        'description' => 'test description updated',
        'comment' => 'test comment updated',
        'text' => 'test text with <b>html</b> updated',
    ];

    public function test_game_rule_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/game-rule/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_game_rule_created_not_successfully_code_400(): void
    {
        GameRule::factory()->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/game-rule/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_game_rule_updated_successfully(): void
    {
        $gameRule = GameRule::factory()->create();

        $response = $this->call('PUT', '/api_V1/game-rule/'.$gameRule->id, self::UPDATED_BASIC_ATTRIBUTES);

        $response->assertOk();

        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
    }

    public function test_game_rule_showed_successfully(): void
    {
        $gameRule = GameRule::factory()->create();

        $response = $this->call('GET', '/api_V1/game-rule/'.$gameRule->id);

        $response->assertOk();
    }

    public function test_game_rule_destroyed_successfully(): void
    {
        $gameRule = GameRule::factory()->create();

        $response = $this->call('DELETE', '/api_V1/game-rule/'.$gameRule->id);

        $response->assertOk();
    }
}
