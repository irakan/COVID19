<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class CovidAPIService
{
    private string $url = 'https://api.covid19api.com/summary';

    public function getCovidDataByCountry()
    {
        $response = Http::get($this->url);

        $this->rateLimitCheck($response);

        return $response->json()['Countries'];
    }

    private function rateLimitCheck($response)
    {
        if ($response->header('X-Ratelimit-Remaining') === '0') {
            $resetTime = Carbon::createFromTimestamp($response->header('X-Ratelimit-Reset'), 'UTC');

            throw new \Exception('Rate limit is reached. Rate limit will reset in '.now()->diffInSeconds($resetTime).' seconds.');
        }
    }
}
