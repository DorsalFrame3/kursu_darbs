<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'feature', 'image'];

    public function favoritedBy()
    {
        return $this->morphToMany(User::class, 'favoritable', 'favorites');
    }
}
