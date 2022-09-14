<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\Location\LocationCollection;
use App\Http\Resources\Location\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderBy('id', 'desc')->paginate(10);

        $json = [
            'status' => ApiFormatter::getResponse(200, 'get'),
            'data' => new LocationCollection($locations)
        ];

        return response($json, 200);


    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required|unique:locations'
            ]
        );

        if ($validator->fails()) {
            $json = [
                'status' => ApiFormatter::getResponse(400, 'error'),
                'message' => $validator->errors()
            ];

            return response($json, 400);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $location = Location::create($data);

        $json = [
            'status' => ApiFormatter::getResponse(201, 'post'),
            'data' => new LocationResource($location)
        ];

        return response($json, 201);
    }

    public function update(Request $request, $slug)
    {
        $location = Location::where('slug', $slug)->first();

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $location->update($data);

        $json = [
            'status' => ApiFormatter::getResponse(201, 'patch')
        ];

        return response($json, 201);

    }

    public function destroy($slug)
    {
        Location::where('slug', $slug)->delete();

        $json = [
            'status' => ApiFormatter::getResponse(200, 'delete')
        ];

        return response($json, 200);

    }
}
