<?php

namespace Tests\Feature;

use App\Jobs\FillCountriesData;
use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
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
                        'CountryCode' => 'AF',
                        'Country' => 'Afghanistan',
                        'TotalConfirmed' => 183084,
                        'TotalRecovered' => 0,
                        'TotalDeaths' => 7727,
                    ],
                    [
                        'CountryCode' => 'AL',
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

        $this->assertDatabaseHas('countries', [
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);
        $this->assertDatabaseCount('countries', 2);
    }

    /** @test */
    public function update_existing_covid_data_when_api_gets_hit()
    {
        Country::factory()->create([
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);

        Http::fake([
            'https://api.covid19api.com/summary' => Http::response([
                'Countries' => [
                    [
                        'CountryCode' => 'AF',
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

        $this->assertDatabaseHas('countries', [
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 1000,
            'total_recovered' => 5,
            'total_deaths' => 2000,
        ]);
        $this->assertDatabaseCount('countries', 1);
    }

    /** @test */
    public function a_job_is_pushed_to_a_the_queue()
    {
        Queue::fake();
        $this->login();

        $this->json('post', '/api/fill_data')->assertSuccessful();

        Queue::assertPushed(FillCountriesData::class);
    }

    /** @test */
    public function return_fail_response_if_queue_already_has_job()
    {
        $queue = Queue::partialMock();

        $queue->shouldReceive('size')->andReturn(1);

        $this->login();

        $this->json('post', '/api/fill_data')->assertJson([
            'status' => 'fail',
            'message' => 'لا زال يتم العمل على تعبئة البيانات.',
        ]);
    }

    /** @test */
    public function return_success_response()
    {
        Queue::fake();

        $this->login();

        Http::fake([
            'https://api.covid19api.com/summary' => Http::response([
                'Countries' => [
                    [
                        'CountryCode' => 'AF',
                        'Country' => 'Afghanistan',
                        'TotalConfirmed' => 1000,
                        'TotalRecovered' => 5,
                        'TotalDeaths' => 2000,
                    ],
                ],
            ], 200),
        ]);

        $response = $this->json('post', '/api/fill_data');

        $response->assertSuccessful();
        $response->assertJsonFragment([
            'message' => 'تم إرسال طلب لتعبئة البيانات في الخلفية.',
            'status' => 'success',
        ]);
    }
}
