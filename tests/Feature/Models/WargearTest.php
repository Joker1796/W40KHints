<?php

namespace Feature\Models;

use App\Models\Ability;
use App\Models\Wargear;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class WargearTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test wargear',
        'description' => 'test description',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test wargear updated',
        'description' => 'test description updated',
    ];

    public function test_wargear_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/wargear/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_wargear_with_ability_created_successfully(): void
    {
        $ability = Ability::factory()->create();

        $arguments = self::BASE_ATTRIBUTES;
        $arguments['abilities'] = [$ability->id];

        $response = $this->call('GET', '/api_V1/wargear/create', $arguments);

        $response->assertOk();
    }

    public function test_wargear_created_not_successfully_code_400(): void
    {
        Wargear::factory()
            ->has(Ability::factory())
            ->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/wargear/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_wargear_updated_successfully(): void
    {
        $wargear = Wargear::factory()->create();

        $response = $this->call('PUT', '/api_V1/wargear/'.$wargear->id, self::UPDATED_BASIC_ATTRIBUTES);

        $response->assertOk();
        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
    }

    public function test_wargear_showed_successfully(): void
    {
        $wargear = Wargear::factory()->create();

        $response = $this->call('GET', '/api_V1/wargear/'.$wargear->id);

        $response->assertOk();
    }

    public function test_wargear_soft_delete_successfully(): void
    {
        $wargear = Wargear::factory()->create();

        $response = $this->call('DELETE', '/api_V1/wargear/'.$wargear->id);

        $response->assertOk();

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('deleted_at', $content);
        $this->assertNotNull($content['deleted_at']);
    }

    public function test_wargear_attach_ability_successfully(): void
    {
        $wargear = Wargear::factory()->create();
        $ability = Ability::factory()->create();

        $response = $this->attachAbility($wargear->id, $ability->id);

        $response->assertOk();
    }

    public function test_wargear_detach_ability_successfully(): void
    {
        $wargear = Wargear::factory()->create();
        $ability = Ability::factory()->create();

        $responseAttach = $this->attachAbility($wargear->id, $ability->id);

        $responseAttach->assertOk();

        $responseDetach = $this->call('DELETE', '/api_V1/wargear/'.$wargear->id.'/ability/'.$ability->id);

        $responseDetach->assertOk();
    }

    private function attachAbility($wargearId, $abilityId): TestResponse
    {
        return $this->call('PUT', '/api_V1/wargear/'.$wargearId.'/ability/'.$abilityId);
    }
}
