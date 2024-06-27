<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laptop extends Model
{
    use HasFactory;
    protected $table = 'laptops';
    protected $fillable = [
        'sr_number',
    ];

    public function getuidAttribute()
    {
        $sr_number = $this->getAttribute('sr_number'); // Safely access serial_number
        return "{$sr_number}-LPT";
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(manufacturer::class);
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(processor::class);
    }
}
