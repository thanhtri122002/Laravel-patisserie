<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'display_name',
        'phone',
        'address',
        'bio'
    ];
    protected $hidden = [
        'profilable_id',
        'profilable_type',
        'created_at',
        'updated_at'
    ];

    public function profilable(): MorphTo
    {
        return $this->morphTo();
    }
    public function profilePictures(): HasMany
    {
        return $this->hasMany(ProfilePicture::class);
    }
}
