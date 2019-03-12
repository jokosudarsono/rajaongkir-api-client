<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Libraries\RajaOngkir;

class RajaOngkirExampleController extends Controller
{
    public function province(Request $request)
    {
        return response()->json(['data' => RajaOngkir::get('province')]);
    }

    public function city(Request $request)
    {
        return response()->json(['data' => RajaOngkir::get('city', [
                'province' => $request->province_id
            ])]);
    }

    public function cost(Request $request)
    {
        $data = [
            'origin' => $request->origin,
            'originType' => $request->originType,
            'destination' => $request->destination,
            'destinationType' => $request->destinationType,
            'weight' => $request->weight,
            'courier' => $request->courier
        ];

        return response()->json(['data' => RajaOngkir::post('cost', $data)]);
    }

    public function subDistrict(Request $request)
    {
        return response()->json(['data' => RajaOngkir::get('subdistrict', ['city' => $request->city])]);
    }

    public function subDistrictDetails($id)
    {
        return response()->json(['data' => RajaOngkir::get('subdistrict', ['id' => $id])]);
    }
}
