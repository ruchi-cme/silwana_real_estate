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
        $data['blockData'] = Block_name_mapping::where("project_id",$request->project_id)
            ->where("status",1)
            ->where("deleted",0)
            ->get(["block_name", "block_name_map_id"]);;
        return response()->json($data);
    }
}
