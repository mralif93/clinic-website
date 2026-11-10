<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScreenerResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'screener_type',
        'session_id',
        'client_name',
        'client_email',
        'client_phone',
        'depression_score',
        'depression_severity',
        'anxiety_score',
        'anxiety_severity',
        'stress_score',
        'stress_severity',
        'answers',
        'recommended_services',
    ];

    protected function casts(): array
    {
        return [
            'answers' => 'array',
            'depression_score' => 'integer',
            'anxiety_score' => 'integer',
            'stress_score' => 'integer',
        ];
    }
}
