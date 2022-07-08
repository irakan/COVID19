<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CovidAPIService;

class FillDataController extends Controller
{
    public function __invoke(CovidAPIService $service)
    {
        $countries = $service->getCovidDataByCountry();

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['country' => $country['Country']],
                [
                    'country' => $country['Country'],
                    'total_confirmed' => $country['TotalConfirmed'],
                    'total_recovered' => $country['TotalRecovered'],
                    'total_deaths' => $country['TotalDeaths'],
                ]
            );
        }
    }
}
