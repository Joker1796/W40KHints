<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class KeywordTest extends TestCase
{
    use RefreshDatabase;

    public function test_keyword_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_keyword_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_keyword_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = ['name' => 'test keyword updated'];
        $response = $this->call('PUT', '/api_V1/keyword/'.$content->id, $arguments);

        $response->assertOk();
        $response->assertJsonFragment($arguments);
    }

    public function test_keyword_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/keyword/'.$content->id);

        $response->assertOk();
    }

    public function test_keyword_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/keyword/'.$content->id);

        $response->assertOk();
    }

    private function callCreateMethod(): TestResponse
    {
        $arguments = ['name' => 'test keyword'];

        return $this->call('GET', '/api_V1/keyword/create', $arguments);
    }
}
