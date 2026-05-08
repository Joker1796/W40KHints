<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $name
 * @property string $description
 * @property string|null $comment
 * @property int $version
 * @property int $is_deleted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Wargear> $abilities
 * @property-read int|null $abilities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ability whereVersion($value)
 */
	class Ability extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $name
 * @property string|null $description
 * @property string|null $comment
 * @property string $text
 * @property int $version
 * @property int $is_deleted
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GameRule whereVersion($value)
 */
	class GameRule extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $name
 * @method static \Database\Factories\KeywordFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Keyword whereUpdatedAt($value)
 */
	class Keyword extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Carbon\CarbonImmutable|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property string $name
 * @property string $description
 * @property int $version
 * @property int $is_deleted
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ability> $abilities
 * @property-read int|null $abilities_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereIsDeleted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Wargear whereVersion($value)
 */
	class Wargear extends \Eloquent {}
}

