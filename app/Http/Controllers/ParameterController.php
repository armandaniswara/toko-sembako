<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Shipment;

class ParameterController extends Controller
{

    public function index(Request $request)
    {
        $type = $request->get('type');

        $models = [
            'payment' => Payment::class,
            'shipment' => Shipment::class,
        ];

        if (!array_key_exists($type, $models)) {
            return view('admin.parameter', ['data' => [], 'type' => $type]);
        }

        $modelClass = $models[$type];
        $data = $modelClass::all();

        return view('admin.parameter', compact('data', 'type'));
    }

}
