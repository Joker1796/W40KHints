<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RuleTest extends TestCase
{
    use RefreshDatabase;

    public function test_rule_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_rule_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_rule_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = [
            'name' => 'test rule updated',
            'description' => 'test description updated',
            'html' => 'test <b>html</b> updated',
            'isNewVersion' => true,
        ];
        $response = $this->call('PUT', '/api_V1/rule/'.$content->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test rule updated',
            'description' => 'test description updated',
            'html' => 'test <b>html</b> updated',
            'version' => 2,
        ];
        $response->assertJsonFragment($arguments);
    }

    public function test_rule_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/rule/'.$content->id);

        $response->assertOk();
    }

    public function test_rule_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/rule/'.$content->id);

        $response->assertOk();
    }

    private function callCreateMethod(): TestResponse
    {
        $arguments = [
            'name' => 'test rule',
            'description' => 'test description',
            'html' => 'test <b>html</b>',
            'version' => 1,
        ];

        return $this->call('GET', '/api_V1/rule/create', $arguments);
    }
}
