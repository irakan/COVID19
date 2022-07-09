<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountriesSummaryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function countries_summary_data_are_loaded()
    {
        Country::factory()->create([
            'country' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        $response = $this->json('get', route('countries.summary'))->assertSuccessful();

        $response->assertJsonFragment([
            'Country' => 'Afghanistan',
            'TotalConfirmed' => 183084,
            'TotalRecovered' => 0,
            'TotalDeaths' => 7727,
        ]);
    }
}
