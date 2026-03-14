<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
        'location_address',
    ];

    // ── Relationships ──────────────────────────────────────

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
