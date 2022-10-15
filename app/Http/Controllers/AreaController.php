<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //SELECT id, nombre FROM areas;
        $areas = Area::select('id', 'nombre')->get();

        $data = $areas->map(function ($area) {
            return [
                'area_id' => $area->id,
                'area_nombre' => $area->nombre,
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de areas disponibles',
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
        //Validación
        $request->validate([
            'nombre' => ['required'],
            'interno' => ['required', 'integer', 'max:4'],
        ]);

        $area = Area::create([
            'nombre' => $request['nombre'],
            'interno' => $request['interno'],
        ]);

        return response()->json([
            'mensaje' => 'Se Agrego Correctamente el area',
            'data' => $area,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $data = Area::findOrFail($id);

        $area = [
            'area_id' => $data->id,
            'area_nombre' => $data->nombre,
            'area_interno' => $data->interno,
        ];

        return response()->json([
            'mensaje' => 'Datos del area solicitada',
            'data' => $area,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => ['required'],
            'interno' => ['required', 'integer', 'max:4'],
        ]);

        $area = Area::findOrFail($id);
        $area->nombre = $request['nombre'];
        $area->interno = $request['interno'];
        $area->save();

        return response()->json([
            'mensaje' => 'Datos del area modificada',
            'data' => $area,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();

        return response()->json([
            'mensaje' => 'El area se elimino correctamente',
            'data' => $area,
        ]);
    }
}
