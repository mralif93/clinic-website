<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'summary',
        'description',
        'target_audience',
        'price',
        'deposit_amount',
        'duration_minutes',
        'image_path',
        'allows_online',
        'allows_in_person',
        'is_featured',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'deposit_amount' => 'decimal:2',
            'duration_minutes' => 'integer',
            'allows_online' => 'boolean',
            'allows_in_person' => 'boolean',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
}
