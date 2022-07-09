<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryCollection;
use App\Models\Country;

class SummaryController extends Controller
{
    public function __invoke()
    {
        $countries = Country::select('code', 'name', 'total_confirmed', 'total_recovered', 'total_deaths')->get();

        return new CountryCollection($countries);
    }
}
