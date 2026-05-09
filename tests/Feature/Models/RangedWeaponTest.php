<?php

namespace Feature\Models;

use App\Models\Keyword;
use App\Models\RangedWeapon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class RangedWeaponTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test ranged weapon',
        'description' => 'test description',
        'range' => 'test description',
        'A' => '2',
        'BS' => '3+',
        'S' => '6',
        'AP' => '-2',
        'D' => 'D3+1',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test ranged weapon updated',
        'description' => 'test description updated',
        'range' => 'test description updated',
        'A' => '5',
        'BS' => '2+',
        'S' => '10',
        'AP' => '-4',
        'D' => 'D6+1',
    ];

    public function test_ranged_weapon_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/ranged-weapon/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_ranged_weapon_with_keyword_created_successfully(): void
    {
        $keyword = Keyword::factory()->create();

        $arguments = self::BASE_ATTRIBUTES;
        $arguments['keywords'] = [$keyword->id];

        $response = $this->call('GET', '/api_V1/ranged-weapon/create', $arguments);

        $response->assertOk();
    }

    public function test_ranged_weapon_created_not_successfully_code_400(): void
    {
        RangedWeapon::factory()->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/ranged-weapon/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_ranged_weapon_updated_successfully(): void
    {
        $rangedWeapon = RangedWeapon::factory()->create();

        $response = $this->call(
            'PUT',
            '/api_V1/ranged-weapon/'.$rangedWeapon->id, self::UPDATED_BASIC_ATTRIBUTES
        );

        $response->assertOk();

        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
    }

    public function test_ranged_weapon_showed_successfully(): void
    {
        $rangedWeapon = RangedWeapon::factory()->create();

        $response = $this->call('GET', '/api_V1/ranged-weapon/'.$rangedWeapon->id);

        $response->assertOk();
    }

    public function test_ranged_weapon_soft_delete_successfully(): void
    {
        $rangedWeapon = RangedWeapon::factory()->create();

        $response = $this->call('DELETE', '/api_V1/ranged-weapon/'.$rangedWeapon->id);

        $response->assertOk();

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('deleted_at', $content);
        $this->assertNotNull($content['deleted_at']);
    }

    public function test_ranged_weapon_attach_keyword_successfully(): void
    {
        $rangedWeapon = RangedWeapon::factory()->create();
        $keyword = Keyword::factory()->create();

        $response = $this->attachKeyword($rangedWeapon->id, $keyword->id);

        $response->assertOk();
    }

    public function test_ranged_weapon_detach_keyword_successfully(): void
    {
        $rangedWeapon = RangedWeapon::factory()->create();
        $keyword = Keyword::factory()->create();

        $responseAttach = $this->attachKeyword($rangedWeapon->id, $keyword->id);

        $responseAttach->assertOk();

        $responseDetach = $this->call(
            'DELETE',
            '/api_V1/ranged-weapon/'.$rangedWeapon->id.'/keyword/'.$keyword->id
        );

        $responseDetach->assertOk();
    }

    private function attachKeyword($rangedWeaponId, $keywordId): TestResponse
    {
        return $this->call('PUT', '/api_V1/ranged-weapon/'.$rangedWeaponId.'/keyword/'.$keywordId);
    }
}
