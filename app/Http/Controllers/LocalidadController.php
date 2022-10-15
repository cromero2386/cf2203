<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use Illuminate\Http\Request;

class LocalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $localidades = Localidad::select('id', 'nombre')->get();

        $data = $localidades->map(function ($localidad) {
            return [
                'id' => $localidad->id,
                'nombre' => $localidad->nombre,
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de localidades disponibles',
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
        $request->validate([
            'nombre' => ['required'],
            'provincia_id' => ['required', 'integer'],
        ]);

        $localidad = Localidad::create([
            'nombre' => $request['nombre'],
            'provincia_id' => $request['provincia_id'],
        ]);

        return response()->json([
            'mensaje' => 'Se Agrego Correctamente la localidad',
            'data' => $localidad,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $data = Localidad::findOrFail($id);

        $localidad = [
            'id' => $data->id,
            'nombre' => $data->nombre,
            'provincia_id' => $data->provincia_id,
        ];

        return response()->json([
            'mensaje' => 'Datos de la localidad solicitada',
            'data' => $localidad,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => ['required'],
            'provincia_id' => ['required', 'integer'],
        ]);

        $localidad = Localidad::findOrFail($id);
        $localidad->nombre = $request['nombre'];
        $localidad->provincia_id = $request['provincia_id'];
        $localidad->save();

        return response()->json([
            'mensaje' => 'Datos de la localidad modificada',
            'data' => $localidad,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localidad  $localidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $localidad = Localidad::findOrFail($id);
        $localidad->delete();

        return response()->json([
            'mensaje' => 'La localidad se elimino correctamente',
            'data' => $localidad,
        ]);
    }
}
