<?php

namespace App\Jobs;

use App\Models\Country;
use App\Services\CovidAPIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FillCountriesData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private CovidAPIService $service)
    {
    }

    public function handle()
    {
        $countries = $this->service->getCovidDataByCountry();

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['code' => $country['CountryCode']],
                [
                    'code' => $country['CountryCode'],
                    'name' => $country['Country'],
                    'total_confirmed' => $country['TotalConfirmed'],
                    'total_recovered' => $country['TotalRecovered'],
                    'total_deaths' => $country['TotalDeaths'],
                ]
            );
        }
    }
}
