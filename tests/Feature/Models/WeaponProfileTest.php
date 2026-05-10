<?php

namespace Feature\Models;

use App\Models\Keyword;
use App\Models\Weapon;
use App\Models\WeaponProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class WeaponProfileTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test weapon profile',
        'range' => '9',
        'attacks' => '2',
        'skills' => '3+',
        'strength' => '6',
        'penetration' => '-2',
        'damage' => 'D3+1',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test weapon profile updated',
        'range' => '24',
        'attacks' => '5',
        'skills' => '2+',
        'strength' => '10',
        'penetration' => '-4',
        'damage' => 'D6+1',
    ];

    public function test_weapon_profile_created_successfully(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->call(
            'GET',
            '/api_V1/weapon/'.$weapon->id.'/weapon-profile/create',
            self::BASE_ATTRIBUTES
        );

        $response->assertOk();
    }

    public function test_weapon_profile_with_keyword_created_successfully(): void
    {
        $weapon = Weapon::factory()->create();
        $keyword = Keyword::factory()->create();

        $arguments = self::BASE_ATTRIBUTES;
        $arguments['keywords'] = [$keyword->id];

        $response = $this->call(
            'GET',
            '/api_V1/weapon/'.$weapon->id.'/weapon-profile/create',
            $arguments
        );

        $response->assertOk();
    }

    public function test_weapon_profile_created_not_successfully_code_400(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->call(
            'GET',
            '/api_V1/weapon/'.$weapon->id.'/weapon-profile/create',
            self::BASE_ATTRIBUTES
        );

        $response->assertOk();

        $response = $this->call(
            'GET',
            '/api_V1/weapon/'.$weapon->id.'/weapon-profile/create',
            self::BASE_ATTRIBUTES
        );

        $response->assertStatus(400);
    }

    public function test_weapon_profile_updated_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();

        $response = $this->call(
            'PUT',
            '/api_V1/weapon-profile/'.$weapon->weaponProfiles()->first()->id,
            self::UPDATED_BASIC_ATTRIBUTES
        );

        $response->assertOk();
        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
    }

    public function test_weapon_profile_showed_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();

        $response = $this->call('GET', '/api_V1/weapon-profile/'.$weapon->weaponProfiles()->first()->id);

        $response->assertOk();
    }

    public function test_weapon_profile_soft_delete_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();

        $response = $this->call('DELETE', '/api_V1/weapon-profile/'.$weapon->weaponProfiles()->first()->id);

        $response->assertOk();

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('deleted_at', $content);
        $this->assertNotNull($content['deleted_at']);
    }

    public function test_weapon_profile_attach_keyword_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();
        $keyword = Keyword::factory()->create();

        $response = $this->attachKeyword($weapon->weaponProfiles()->first()->id, $keyword->id);

        $response->assertOk();
    }

    public function test_weapon_profile_detach_keyword_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();
        $keyword = Keyword::factory()->create();

        $responseAttach = $this->attachKeyword($weapon->weaponProfiles()->first()->id, $keyword->id);

        $responseAttach->assertOk();

        $responseDetach = $this->call(
            'DELETE',
            '/api_V1/weapon-profile/'.$weapon->weaponProfiles()->first()->id.'/keyword/'.$keyword->id
        );

        $responseDetach->assertOk();
    }

    private function attachKeyword($weaponProfileId, $keywordId): TestResponse
    {
        return $this->call('PUT', '/api_V1/weapon-profile/'.$weaponProfileId.'/keyword/'.$keywordId);
    }
}
