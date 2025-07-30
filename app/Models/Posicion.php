<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    public $timestamps = false;
    protected $table = 'posiciones';

    public function seleccion() {
        return $this->belongsTo(Seleccion::class, 'seleccion_id');
    }
}
