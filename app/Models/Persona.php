<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'personas';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'correo',
        'dni',
        'legajo',
        'fechaNacimiento',
        'area_id',
        'barrio_id',
        'provincia_id',
    ];

    /**
     * Obtiene el barrio de la persona
     */
    public function barrio()
    {
        return $this->belongsTo(Barrio::class, 'barrio_id', 'id');
    }

    /**
     * Obtiene el barrio de la persona
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    /**
     * Obtiene la provinica de origen de la persona
     */
    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id', 'id');
    }
}
