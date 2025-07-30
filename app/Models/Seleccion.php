<?php

use Illuminate\Database\Eloquent\Model;

class Seleccion extends Model{

    public $timestamps = false;
    protected $table = 'selecciones';

    public function partidos_local(){
        return $this->hasMany(Resultado::class, 'local_id');
    }
    public function partidos_visitante(){
        return $this->hasMany(Resulado::class, 'visitante_id');
    }
    public function posicion(){
        return $this->hasOne(Posicion::class, 'seleccion_id');
    }
}
