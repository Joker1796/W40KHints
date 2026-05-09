<?php

namespace Feature\Models;

use App\Models\Keyword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KeywordTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = ['name' => 'test keyword'];
    const array UPDATED_ATTRIBUTES = ['name' => 'test keyword updated'];

    public function test_keyword_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/keyword/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_keyword_created_not_successfully_code_400(): void
    {
        Keyword::factory()->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/keyword/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_keyword_updated_successfully(): void
    {
        $keyword = Keyword::factory()->create();

        $response = $this->call('PUT', '/api_V1/keyword/'.$keyword->id, self::UPDATED_ATTRIBUTES);

        $response->assertOk();
        $response->assertJsonFragment(self::UPDATED_ATTRIBUTES);
    }

    public function test_keyword_showed_successfully(): void
    {
        $keyword = Keyword::factory()->create();

        $response = $this->call('GET', '/api_V1/keyword/'.$keyword->id);

        $response->assertOk();
    }

    public function test_keyword_destroyed_successfully(): void
    {
        $keyword = Keyword::factory()->create();

        $response = $this->call('DELETE', '/api_V1/keyword/'.$keyword->id);

        $response->assertOk();
    }
}
