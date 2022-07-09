<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function __invoke(Request $request)
    {
        $countries = Country::select('country', 'total_confirmed', 'total_recovered', 'total_deaths')->get();

        return new CountryCollection($countries);
    }
}
