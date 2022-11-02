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
        $data['countries'] = Country::where("sortname",$request->sortname)->get(["name", "id"]);

        return response()->json($data);
    }
}
