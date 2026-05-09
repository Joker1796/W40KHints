<?php

namespace Feature\Models;

use App\Models\Ability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AbilityTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test ability',
        'description' => 'test description',
        'comment' => 'test comment with <b>html</b>',
        'version' => 1,
    ];
    const array UPDATED_ATTRIBUTES = ['name' => 'test keyword updated'];

    public function test_ability_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/ability/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_ability_created_not_successfully_code_400(): void
    {
        Ability::factory()->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/ability/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_ability_updated_successfully(): void
    {
        $ability = Ability::factory()->create();

        $arguments = [
            'name' => 'test ability updated',
            'description' => 'test description updated',
            'comment' => 'test comment with <b>html</b> updated',
            'isNewVersion' => true,
        ];

        $response = $this->call('PUT', '/api_V1/ability/'.$ability->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test ability updated',
            'description' => 'test description updated',
            'comment' => 'test comment with <b>html</b> updated',
            'version' => 2,
        ];

        $response->assertJsonFragment($arguments);
    }

    public function test_ability_showed_successfully(): void
    {
        $ability = Ability::factory()->create();

        $response = $this->call('GET', '/api_V1/ability/'.$ability->id);

        $response->assertOk();
    }

    public function test_ability_destroyed_successfully(): void
    {
        $ability = Ability::factory()->create();

        $response = $this->call('DELETE', '/api_V1/ability/'.$ability->id);

        $response->assertOk();
    }
}
