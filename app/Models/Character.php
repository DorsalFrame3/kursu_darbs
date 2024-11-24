<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'bounty', 'image', 'fruit_id', 'weapon_id', 'location_id', 'organization_id', 'race_id'];

    public function favoritedBy()
    {
        return $this->morphToMany(User::class, 'favoritable', 'favorites');
    }

    public function fruit()
    {
        return $this->belongsTo(Fruit::class);
    }

    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function race()
    {
        return $this->belongsTo(Race::class);
    }
}
