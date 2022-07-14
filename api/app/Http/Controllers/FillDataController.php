<?php

namespace App\Http\Controllers;

use App\Jobs\FillCountriesData;
use App\Services\CovidAPIService;
use Illuminate\Support\Facades\Queue;

class FillDataController extends Controller
{
    public function __invoke(CovidAPIService $service)
    {
        if (Queue::size('default') > 0) {
            return response()->json([
                'message' => 'لا زال يتم العمل على تعبئة البيانات.',
                'status' => 'fail',
            ]);
        }

        FillCountriesData::dispatch($service);

        return response()->json([
            'message' => 'جاري العمل على تعبئة البيانات في الخلفية.',
            'status' => 'success',
        ]);
    }
}
