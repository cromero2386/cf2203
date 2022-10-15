<?php

namespace App\Http\Controllers;

use App\Models\Barrio;
use Illuminate\Http\Request;

class BarrioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barrios = Barrio::select('id', 'nombre')->get();

        $data = $barrios->map(function ($barrio) {
            return [
                'id' => $barrio->id,
                'nombre' => $barrio->nombre,
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de barrios disponibles',
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
            'localidad_id' => ['required', 'integer'],
        ]);

        $barrio = Barrio::create([
            'nombre' => $request['nombre'],
            'localidad_id' => $request['localidad_id'],
        ]);

        return response()->json([
            'mensaje' => 'Se Agrego Correctamente el barrio',
            'data' => $barrio,
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
        $data = Barrio::findOrFail($id);

        $barrio = [
            'id' => $data->id,
            'nombre' => $data->nombre,
            'localidad_id' => $data->localidad_id,
        ];

        return response()->json([
            'mensaje' => 'Datos del barrio solicitado',
            'data' => $barrio,
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
            'localidad_id' => ['required', 'integer'],
        ]);

        $barrio = Barrio::findOrFail($id);
        $barrio->nombre = $request['nombre'];
        $barrio->localidad_id = $request['localidad_id'];
        $barrio->save();

        return response()->json([
            'mensaje' => 'Datos del barrio modificado',
            'data' => $barrio,
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
        $barrio = Barrio::findOrFail($id);
        $barrio->delete();

        return response()->json([
            'mensaje' => 'El barrio se elimino correctamente',
            'data' => $barrio,
        ]);
    }
}
