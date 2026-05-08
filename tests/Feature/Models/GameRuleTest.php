<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class GameRuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_rule_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_game_rule_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_game_rule_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = [
            'name' => 'test game rule updated',
            'description' => 'test description updated',
            'comment' => 'test comment updated',
            'text' => 'test text with <b>html</b> updated',
            'isNewVersion' => true,
        ];
        $response = $this->call('PUT', '/api_V1/game-rule/'.$content->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test game rule updated',
            'description' => 'test description updated',
            'comment' => 'test comment updated',
            'text' => 'test text with <b>html</b> updated',
        ];
        $response->assertJsonFragment($arguments);
    }

    public function test_game_rule_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/game-rule/'.$content->id);

        $response->assertOk();
    }

    public function test_game_rule_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/game-rule/'.$content->id);

        $response->assertOk();
    }

    private function callCreateMethod(): TestResponse
    {
        $arguments = [
            'name' => 'test game rule',
            'description' => 'test description',
            'comment' => 'test comment',
            'text' => 'test text with <b>html</b>',
            'version' => 1,
        ];

        return $this->call('GET', '/api_V1/game-rule/create', $arguments);
    }
}
