<?php

namespace App\Http\Controllers;

use App\Http\Resources\CountryCollection;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = Country::filter($request->only('name'))->paginate(10);

        return new CountryCollection($countries);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
}
