<?php

namespace App\Http\Controllers;
use Validator;
use Response;
use Redirect;
use App\Models\{Country, State, City, Block_name_mapping};
use Illuminate\Http\Request;

class CountryStateCityController extends Controller
{
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
    public function fetchBlock(Request $request)
    {
        $data['blockData'] = getBlockData($request->project_id);
        return response()->json($data);
    }
    public function fetchCountry(Request $request)
    {
        $selectedCountries = Country::where("sortname",$request->sortname)->get(["name", "id"])->first();

        $data['chooseCountryId'] = $selectedCountries['id'];
        $data['countries'] = Country::all();

        return response()->json($data);
    }

    public function selectState(Request $request)
    {
        $data['countries'] = State::where("name",$request->sortname)->get(["name", "id"]);
        return response()->json($data);
    }

    public function selectCity(Request $request)
    {
        $data['countries'] = City::where("name",$request->sortname)->get(["name", "id"]);
        return response()->json($data);
    }
}
