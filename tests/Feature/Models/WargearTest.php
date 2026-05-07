<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class WargearTest extends TestCase
{
    use RefreshDatabase;

    public function test_wargear_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_wargear_with_ability_created_successfully(): void
    {
        $response = $this->callCreateMethod(true);

        $response->assertOk();
    }

    public function test_wargear_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_wargear_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = [
            'name' => 'test wargear updated',
            'description' => 'test description updated',
            'isNewVersion' => true,
        ];
        $response = $this->call('PUT', '/api_V1/wargear/'.$content->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test wargear updated',
            'description' => 'test description updated',
        ];
        $response->assertJsonFragment($arguments);
    }

    public function test_wargear_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/wargear/'.$content->id);

        $response->assertOk();
    }

    public function test_wargear_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/wargear/'.$content->id);

        $response->assertOk();
    }

    public function test_wargear_attach_ability_successfully(): void
    {
        $responseWargear = $this->callCreateMethod();
        $contentWargear = json_decode($responseWargear->getContent());
        $responseAbility = $this->callCreateAbilityMethod();
        $contentAbility = json_decode($responseAbility->getContent());

        $response = $this->attachAbility($contentWargear->id, $contentAbility->id);

        $response->assertOk();
    }

    public function test_wargear_detach_ability_successfully(): void
    {
        $responseWargear = $this->callCreateMethod();
        $contentWargear = json_decode($responseWargear->getContent());
        $responseAbility = $this->callCreateAbilityMethod();
        $contentAbility = json_decode($responseAbility->getContent());

        $responseAttach = $this->attachAbility($contentWargear->id, $contentAbility->id);

        $responseAttach->assertOk();

        $responseDetach = $this->call(
            'DELETE',
            '/api_V1/wargear/'.$contentWargear->id.'/ability/'.$contentAbility->id
        );

        $responseDetach->assertOk();
    }

    private function attachAbility($wargearId, $abilityId): TestResponse
    {
        return $this->call('PUT', '/api_V1/wargear/'.$wargearId.'/ability/'.$abilityId);
    }

    private function callCreateMethod(bool $withAbility = false): TestResponse
    {
        if ($withAbility) {
            $abilityResponse = $this->callCreateAbilityMethod();
            $content = json_decode($abilityResponse->getContent());
        } else {
            $content = [];
        }

        $arguments = [
            'name' => 'test wargear',
            'description' => 'test description',
            'version' => 1,
            'abilities' => $content ? [$content->id] : [],
        ];

        return $this->call('GET', '/api_V1/wargear/create', $arguments);
    }

    private function callCreateAbilityMethod(): TestResponse
    {
        $arguments = [
            'name' => 'test wargear ability',
            'description' => 'test description',
            'html' => 'test <b>html</b>',
            'version' => 1,
        ];

        return $this->call('GET', '/api_V1/ability/create', $arguments);
    }
}
