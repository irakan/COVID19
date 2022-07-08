<?php

namespace Tests\Feature\Auth;

use App\Models\Covid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PullDataFromApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_access_the_route()
    {
        $this->json('post', 'api/fill_data')->assertUnauthorized();
    }

    /** @test */
    public function insert_covid_data_when_the_api_gets_hit()
    {
        Http::fake([
            'https://api.covid19api.com/summary' => Http::response([
                'Countries' => [
                    [
                        'Country' => 'Afghanistan',
                        'TotalConfirmed' => 183084,
                        'TotalRecovered' => 0,
                        'TotalDeaths' => 7727,
                    ],
                    [
                        'Country' => 'Albania',
                        'TotalConfirmed' => 8056,
                        'TotalRecovered' => 0,
                        'TotalDeaths' => 511,
                    ],
                ],
            ], 200),
        ]);

        $this->login();

        $this->json('post', '/api/fill_data');

        $this->assertDatabaseHas('covids', [
            'country' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);
        $this->assertDatabaseCount('covids', 2);
    }

    /** @test */
    public function update_existing_covid_data_when_api_gets_hit()
    {
        Covid::factory()->create([
            'country' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        Http::fake([
            'https://api.covid19api.com/summary' => Http::response([
                'Countries' => [
                    [
                        'Country' => 'Afghanistan',
                        'TotalConfirmed' => 1000,
                        'TotalRecovered' => 5,
                        'TotalDeaths' => 2000,
                    ],
                ],
            ], 200),
        ]);

        $this->login();

        $this->json('post', '/api/fill_data');

        $this->assertDatabaseHas('covids', [
            'country' => 'Afghanistan',
            'total_confirmed' => 1000,
            'total_recovered' => 5,
            'total_deaths' => 2000,
        ]);
        $this->assertDatabaseCount('covids', 1);
    }
}
