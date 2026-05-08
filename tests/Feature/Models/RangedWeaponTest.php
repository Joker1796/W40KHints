<?php

namespace Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RangedWeaponTest extends TestCase
{
    use RefreshDatabase;

    public function test_ranged_weapon_created_successfully(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();
    }

    public function test_ranged_weapon_with_keyword_created_successfully(): void
    {
        $response = $this->callCreateMethod(true);

        $response->assertOk();
    }

    public function test_ranged_weapon_created_not_successfully_code_400(): void
    {
        $response = $this->callCreateMethod();

        $response->assertOk();

        $response = $this->callCreateMethod();

        $response->assertStatus(400);
    }

    public function test_ranged_weapon_updated_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $arguments = [
            'name' => 'test ranged weapon',
            'description' => 'test description updated',
            'range' => 'test description',
            'A' => '2',
            'BS' => '2+',
            'S' => '6',
            'AP' => '-2',
            'D' => 'D3+1',
            'isNewVersion' => true,
        ];
        $response = $this->call('PUT', '/api_V1/ranged-weapon/'.$content->id, $arguments);

        $response->assertOk();

        $arguments = [
            'name' => 'test ranged weapon',
            'description' => 'test description updated',
            'range' => 'test description',
            'A' => '2',
            'BS' => '2+',
            'S' => '6',
            'AP' => '-2',
            'D' => 'D3+1',
        ];
        $response->assertJsonFragment($arguments);
    }

    public function test_ranged_weapon_showed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('GET', '/api_V1/ranged-weapon/'.$content->id);

        $response->assertOk();
    }

    public function test_ranged_weapon_destroyed_successfully(): void
    {
        $response = $this->callCreateMethod();
        $content = json_decode($response->getContent());

        $response = $this->call('DELETE', '/api_V1/ranged-weapon/'.$content->id);

        $response->assertOk();
    }

    public function test_ranged_weapon_attach_keyword_successfully(): void
    {
        $responseRangedWeapon = $this->callCreateMethod();
        $contentRangedWeapon = json_decode($responseRangedWeapon->getContent());
        $responseKeyword = $this->callCreateKeywordMethod();
        $contentKeyword = json_decode($responseKeyword->getContent());

        $response = $this->attachKeyword($contentRangedWeapon->id, $contentKeyword->id);

        $response->assertOk();
    }

    public function test_ranged_weapon_detach_keyword_successfully(): void
    {
        $responseRangedWeapon = $this->callCreateMethod();
        $contentRangedWeapon = json_decode($responseRangedWeapon->getContent());
        $responseKeyword = $this->callCreateKeywordMethod();
        $contentKeyword = json_decode($responseKeyword->getContent());

        $responseAttach = $this->attachKeyword($contentRangedWeapon->id, $contentKeyword->id);

        $responseAttach->assertOk();

        $responseDetach = $this->call(
            'DELETE',
            '/api_V1/ranged-weapon/'.$contentRangedWeapon->id.'/keyword/'.$contentKeyword->id
        );

        $responseDetach->assertOk();
    }

    private function attachKeyword($rangedWeaponId, $keywordId): TestResponse
    {
        return $this->call('PUT', '/api_V1/ranged-weapon/'.$rangedWeaponId.'/keyword/'.$keywordId);
    }

    private function callCreateMethod(bool $withKeyword = false): TestResponse
    {
        if ($withKeyword) {
            $keywordResponse = $this->callCreateKeywordMethod();
            $content = json_decode($keywordResponse->getContent());
        } else {
            $content = [];
        }

        $arguments = [
            'name' => 'test ranged weapon',
            'description' => 'test description',
            'range' => 'test description',
            'A' => '1',
            'BS' => '3+',
            'S' => '5',
            'AP' => '-1',
            'D' => '2',
            'keywords' => $content ? [$content->id] : [],
        ];

        return $this->call('GET', '/api_V1/ranged-weapon/create', $arguments);
    }

    private function callCreateKeywordMethod(): TestResponse
    {
        $arguments = ['name' => 'test ranged weapon keyword'];

        return $this->call('GET', '/api_V1/keyword/create', $arguments);
    }
}
