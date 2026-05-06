<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AbilityTest extends TestCase
{
    use RefreshDatabase;

    public function test_ability_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_ability_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_ability_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = [
            'name' => 'test ability updated',
            'description' => 'test description updated',
            'html' => 'test <b>html</b> updated',
            'isNewVersion' => true,
        ];
        $response = $this->call('PUT', '/api_V1/ability/'.$content->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test ability updated',
            'description' => 'test description updated',
            'html' => 'test <b>html</b> updated',
        ];
        $response->assertJsonFragment($arguments);
    }

    public function test_ability_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/ability/'.$content->id);

        $response->assertOk();
    }

    public function test_ability_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/ability/'.$content->id);

        $response->assertOk();
    }

    private function callCreateMethod(): TestResponse
    {
        $arguments = [
            'name' => 'test ability',
            'description' => 'test description',
            'html' => 'test <b>html</b>',
            'version' => 1,
        ];

        return $this->call('GET', '/api_V1/ability/create', $arguments);
    }
}
