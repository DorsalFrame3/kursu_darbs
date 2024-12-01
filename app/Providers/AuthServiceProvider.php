<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Character;
use App\Models\Fruit;
use App\Models\Weapon;
use App\Models\Location;
use App\Models\Organization;
use App\Models\Race;

use App\Policies\AdminOnlyPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
            Character::class => AdminOnlyPolicy::class,
            Fruit::class => AdminOnlyPolicy::class,
            Weapon::class => AdminOnlyPolicy::class,
            Location::class => AdminOnlyPolicy::class,
            Organization::class => AdminOnlyPolicy::class,
            Race::class => AdminOnlyPolicy::class,
            Comment::class => CommentPolicy::class
        ];
    public function boot(): void
    {
        Gate::define('create', [AdminOnlyPolicy::class, 'create']);

        Gate::define('upd-del-character', [AdminOnlyPolicy::class, 'updDelCharacter']);
        Gate::define('upd-del-fruit', [AdminOnlyPolicy::class, 'updDelFruit']);
        Gate::define('upd-del-weapon', [AdminOnlyPolicy::class, 'updDelWeapon']);
        Gate::define('upd-del-location', [AdminOnlyPolicy::class, 'updDelLocation']);
        Gate::define('upd-del-organization', [AdminOnlyPolicy::class, 'updDelOrganization']);
        Gate::define('upd-del-race', [AdminOnlyPolicy::class, 'updDelRace']);
    }
        
    }

