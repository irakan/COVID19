<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_access_the_route()
    {
        $country = Country::factory()->create();
        $this->json('get', route('countries.show', $country))->assertUnauthorized();
    }

    /** @test */
    public function a_country_can_be_shown()
    {
        $country = Country::factory()->create();

        $this->login();

        $response = $this->json('get', route('countries.show', $country))->assertSuccessful();

        $response->assertJson([
            'data' => [
                'id' => $country->id,
                'code' => $country->code,
                'name' => $country->name,
                'totalConfirmed' => $country->total_confirmed,
                'totalRecovered' => $country->total_recovered,
                'totalDeaths' => $country->total_deaths,
            ],
            'status' => 'success',
        ]);
    }
}
