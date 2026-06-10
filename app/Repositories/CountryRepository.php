<?php

namespace App\Repositories;

use App\Models\Country;
use Illuminate\Support\Facades\DB;

class CountryRepository
{
    public function replaceAll(array $countries): void
    {
        DB::transaction(function () use ($countries) {
            Country::truncate();
            Country::insert($countries);
        });
    }
}
