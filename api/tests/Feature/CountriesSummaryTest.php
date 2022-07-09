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
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        $response = $this->json('get', route('countries.summary'))->assertSuccessful();

        $response->assertJsonFragment([
            'code' => 'AF',
            'name' => 'Afghanistan',
            'totalConfirmed' => 183084,
            'totalRecovered' => 0,
            'totalDeaths' => 7727,
        ]);
    }
}
