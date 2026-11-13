<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practitioner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'registration_number',
        'bio',
        'specialties',
        'languages',
        'working_days',
        'available_slots',
        'blocked_dates',
        'photo_path',
        'accepts_online',
        'accepts_in_person',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'specialties' => 'array',
            'languages' => 'array',
            'working_days' => 'array',
            'available_slots' => 'array',
            'blocked_dates' => 'array',
            'accepts_online' => 'boolean',
            'accepts_in_person' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
