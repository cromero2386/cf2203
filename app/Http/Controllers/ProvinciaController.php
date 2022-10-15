<?php

namespace App\Http\Controllers;

use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provincias = Provincia::select('id', 'nombre')->get();

        $data = $provincias->map(function ($provincia) {
            return [
                'id' => $provincia->id,
                'nombre' => $provincia->nombre,
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de provincias disponibles',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::get('https://apis.datos.gob.ar/georef/api/provincias');

        $provincias = json_decode($response->getBody(), true);

        foreach ($provincias['provincias'] as $value) {
            Provincia::updateOrCreate([
                'nombre' => $value['nombre'],
            ],
                ['nombre' => $value['nombre']]
            );
        }

        return response()->json(['mensaje' => 'Se inserto las provincias']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provincia  $provincia
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $provincia = Provincia::select('id', 'nombre')->findOrFail($id);

        $data = [
            'id' => $provincia->id,
            'nombre' => $provincia->nombre,
        ];

        return response()->json([
            'mensaje' => 'Datos de la provincia',
            'data' => $data,
        ]);
    }
}
