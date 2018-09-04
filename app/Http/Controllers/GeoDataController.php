<?php

namespace App\Http\Controllers;

use App\GeoData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoDataController extends Controller
{
    protected $geoData;

    public function __construct(geoData $geoData)
    {
        $this->geoData = $geoData;
    }

    // получение геоданных от БД и отправка на фронт-энд
    public function getGeoData()
    {
        $geo = $this->geoData->where('id', 1)->first();
        return response()->json($geo);
    }

    //обновление гоеданных в БД
    public function updateGeoData(Request $request)
    {
        $geoDB = $this->geoData;
        $geoDB->timestamps = false;
        $this->geoData->where('id', 1)->update(['latitude' => $request->lat, 'longtitude' => $request->lng, 'radius' => $request->radius, 'keyword' => $request->keyword]);
        return response()->json($request);
    }


}