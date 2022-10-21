<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::get();

        $data = $personas->map(function ($persona) {
            return [
                'id' => $persona->id,
                'nombre' => $persona->nombre,
            ];
        });

        return response()->json([
            'mensaje' => 'Listado de personas disponibles',
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
            'apellido' => ['required'],
            'correo' => ['required'],
            'dni' => ['required', 'integer'],
            'area_id' => ['required'],
            'barrio_id' => ['required'],
            'provincia_id' => ['required'],
        ]);

        $persona = Persona::create([
            'nombre' => $request['nombre'],
            'apellido' => $request['apellido'],
            'correo' => $request['correo'],
            'dni' => $request['dni'],
            'legajo' => Str::random(6),
            'fechaNacimiento' => $request['fechaNacimiento'],
            'area_id' => $request['area_id'],
            'barrio_id' => $request['barrio_id'],
            'provincia_id' => $request['provincia_id'],
        ]);

        return response()->json([
            'mensaje' => 'Se Agrego Correctamente la persona',
            'data' => $persona,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $data = Persona::with('barrio.localidad.provincia', 'area', 'provincia')->findOrFail($id);
        //SELECT * FROM personas WHERE id = $id;

        $persona = [
            'id' => $data->id,
            'nombre' => $data->nombre,
            'apellido' => $data->apellido,
            'barrio' => $data->barrio->nombre,
            'localidad' => $data->barrio->localidad->nombre,
            'area' => $data->area->nombre,
            'provincia_origin' => $data->provincia->nombre,
        ];

        return response()->json([
            'mensaje' => 'Datos de la persona solicitada',
            'data' => $persona,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nombre' => ['required'],
            'apellido' => ['required'],
            'correo' => ['required'],
            'dni' => ['required', 'integer'],
            'area_id' => ['required'],
            'barrio_id' => ['required'],
            'provincia_id' => ['required'],
        ]);

        $persona = Persona::findOrFail($id);
        $persona->nombre = $request['nombre'];
        $persona->apellido = $request['apellido'];
        $persona->correo = $request['correo'];
        $persona->dni = $request['dni'];
        $persona->legajo = $request['legajo'];
        $persona->fechaNacimiento = $request['fechaNacimiento'];
        $persona->area_id = $request['area_id'];
        $persona->barrio_id = $request['barrio_id'];
        $persona->provincia_id = $request['provincia_id'];
        $persona->save();

        return response()->json([
            'mensaje' => 'Datos de la persona modificado',
            'data' => $persona,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return response()->json([
            'mensaje' => 'La persona se elimino correctamente',
            'data' => $persona,
        ]);
    }
}
