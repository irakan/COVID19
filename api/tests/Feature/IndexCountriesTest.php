<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function countries_are_pagnated_by_10_per_page()
    {
        Country::factory()->count(11)->create();

        $response = $this->json('get', route('countries.index'))->assertSuccessful();

        $this->assertCount(10, $response->json('data'));
    }

    /** @test */
    public function needed_countries_data_are_loaded()
    {
        Country::factory()->create([
            'country' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        $response = $this->json('get', route('countries.index'))->assertSuccessful();

        $response->assertJsonFragment([
            'Country' => 'Afghanistan',
            'TotalConfirmed' => 183084,
            'TotalRecovered' => 0,
            'TotalDeaths' => 7727,
        ]);
    }

    /** @test */
    public function countires_can_be_filtered_by_name()
    {
        Country::factory()->create([
            'country' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        Country::factory()->create([
            'country' => 'Albania',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        $this->json('get', route('countries.index', ['name' => 'Albania']))
            ->assertSuccessful()
            ->assertJsonFragment(['Country' => 'Albania'])
            ->assertJsonCount(1, 'data');
    }
}
