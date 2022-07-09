<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryCollection;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::filter($request->only('name', 'order'))
            ->paginate(10);

        return new CountryCollection($countries);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|max:2',
            'name' => 'required|string',
            'total_confirmed' => 'required|integer',
            'total_recovered' => 'required|integer',
            'total_deaths' => 'required|integer',
        ]);

        $country = Country::create($data);

        return CountryResource::make($country);
    }

    public function update(Request $request, $id)
    {
        $country = Country::where('id', $id)->firstOrFail();

        $data = $request->validate([
            'code' => 'required|string|max:2',
            'name' => 'required|string',
            'total_confirmed' => 'required|integer',
            'total_recovered' => 'required|integer',
            'total_deaths' => 'required|integer',
        ]);

        $country->update($data);

        return CountryResource::make($country);
    }
}
