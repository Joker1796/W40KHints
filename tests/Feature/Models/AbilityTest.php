<?php

namespace Feature\Models;

use App\Models\Ability;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AbilityTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test ability',
        'description' => 'test description',
        'comment' => 'test comment with <b>html</b>',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test ability updated',
        'description' => 'test description updated',
        'comment' => 'test comment with <b>html</b> updated',
    ];

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

        $response = $this->call('PUT', '/api_V1/ability/'.$ability->id, self::UPDATED_BASIC_ATTRIBUTES);

        $response->assertOk();

        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
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
