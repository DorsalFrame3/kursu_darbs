<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function characters()
    {
        return $this->morphedByMany(Character::class, 'favoritable', 'favorites');
    }

    public function fruits()
    {
        return $this->morphedByMany(Fruit::class, 'favoritable', 'favorites');
    }

    public function weapons()
    {
        return $this->morphedByMany(Weapon::class, 'favoritable', 'favorites');
    }

    public function locations()
    {
        return $this->morphedByMany(Location::class, 'favoritable', 'favorites');
    }

    public function organizations()
    {
        return $this->morphedByMany(Organization::class, 'favoritable', 'favorites');
    }

    public function races()
    {
        return $this->morphedByMany(Race::class, 'favoritable', 'favorites');
    }
}

