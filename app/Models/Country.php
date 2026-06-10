<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CountryStatus;

class Country extends Model
{
    protected $fillable = ['name', 'status'];

    protected function casts(): array
    {
        return [
            'status' => CountryStatus::class,
        ];
    }
}
