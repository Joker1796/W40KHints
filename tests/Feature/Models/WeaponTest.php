<?php

namespace Feature\Models;

use App\Models\Weapon;
use App\Models\WeaponProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeaponTest extends TestCase
{
    use RefreshDatabase;

    const array BASE_ATTRIBUTES = [
        'name' => 'test weapon',
        'description' => 'test description',
        'type' => '1',
    ];
    const array UPDATED_BASIC_ATTRIBUTES = [
        'name' => 'test weapon updated',
        'description' => 'test description updated',
        'type' => '2',
    ];

    public function test_weapon_created_successfully(): void
    {
        $response = $this->call('GET', '/api_V1/weapon/create', self::BASE_ATTRIBUTES);

        $response->assertOk();
    }

    public function test_weapon_created_not_successfully_code_400(): void
    {
        Weapon::factory()->create(self::BASE_ATTRIBUTES);

        $response = $this->call('GET', '/api_V1/weapon/create', self::BASE_ATTRIBUTES);

        $response->assertStatus(400);
    }

    public function test_weapon_updated_successfully(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->call(
            'PUT',
            '/api_V1/weapon/'.$weapon->id, self::UPDATED_BASIC_ATTRIBUTES
        );

        $response->assertOk();

        $response->assertJsonFragment(self::UPDATED_BASIC_ATTRIBUTES);
    }

    public function test_weapon_showed_successfully(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->call('GET', '/api_V1/weapon/'.$weapon->id);

        $response->assertOk();
    }

    public function test_weapon_soft_delete_successfully(): void
    {
        $weapon = Weapon::factory()->create();

        $response = $this->call('DELETE', '/api_V1/weapon/'.$weapon->id);

        $response->assertOk();

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('deleted_at', $content);
        $this->assertNotNull($content['deleted_at']);
    }

    public function test_weapon_delete_weapon_profile_successfully(): void
    {
        $weapon = Weapon::factory()->has(WeaponProfile::factory())->create();

        $responseDetach = $this->call(
            'DELETE',
            '/api_V1/weapon/'.$weapon->id.'/profile/'.$weapon->weaponProfiles()->first()->id
        );

        $responseDetach->assertOk();
    }
}
