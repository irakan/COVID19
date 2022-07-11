<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateCountriesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_not_access_the_route()
    {
        $this->json('post', 'api/countries')->assertUnauthorized();
    }

    /** @test */
    public function a_user_can_create_a_country()
    {
        $this->login();

        $this->json('post', 'api/countries', [
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ])->assertSuccessful();

        $this->assertDatabaseHas('countries', [
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ]);
    }

    /** @test */
    public function response_will_return_the_created_country()
    {
        $this->login();

        $this->json('post', 'api/countries', [
            'code' => 'AF',
            'name' => 'Afghanistan',
            'total_confirmed' => 183084,
            'total_recovered' => 0,
            'total_deaths' => 7727,
        ])->assertExactJson([
            'data' => [
                'id' => 1,
                'code' => 'AF',
                'name' => 'Afghanistan',
                'totalConfirmed' => 183084,
                'totalRecovered' => 0,
                'totalDeaths' => 7727,
            ],
            'status' => 'success',
        ]);
    }

    /**
     * @test
     * @dataProvider InvalidInputsProvider
     */
    public function a_user_can_not_create_a_country_with_invalid_inputs($input, $value)
    {
        Country::factory()->create(['code' => 'AF']);
        $this->login();

        $this->json('post', 'api/countries', [$input => $value])->assertJsonValidationErrors($input);
    }

    public function InvalidInputsProvider()
    {
        return [
            'empty_country_name' => ['name', ''],
            'empty_total_confirmed' => ['total_confirmed', ''],
            'empty_total_recovered' => ['total_recovered', ''],

            'invalid_country_name' => ['name', 123456],
            'invalid_total_confirmed' => ['total_confirmed', 'abc'],
            'invalid_total_recovered' => ['total_recovered', 'abc'],
            'invalid_total_deaths' => ['total_deaths', 'abc'],

            'country_code_must_be_unique' => ['code', 'AF'],
            'country_code_must_be_2_characters' => ['code', 'AFGH'],
        ];
    }
}
