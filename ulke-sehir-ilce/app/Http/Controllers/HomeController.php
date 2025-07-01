<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\City;
use App\Models\District;

class HomeController extends Controller
{
    //
    public function index()
{
   /*  $countries = Country::all();
    return view('welcome', compact('countries')); */
    $countries = Country::where('id', 214)->get();
    return view('welcome', compact('countries'));
}
public function getCities($countryId)
{
    return City::where('country_id', $countryId)->get();
}

public function getDistricts($cityId)
{
    return District::where('city_id', $cityId)->get();
}
}
