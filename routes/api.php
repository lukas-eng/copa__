<?php
use App\Models\Seleccion;
use App\Models\Resultado;
use App\Models\Posicion;


Route::get('/selecciones', function(){
    return Seleccion::select('id', 'nombre')->get();
});

Route::get('/resultados', function(){
    return Resultado::with(['local', 'visitante'])->get()->map(function ($r){
        return [
            'id' => $r->id,
            'seleccion_a' => $r->local->nombre,
            'seleccion_b' => $r->visitante->nombre,
            'goles_a' => $r->goles_local,
            'goles_b' => $r->goles_visitante,
            'fecha' => $r->fecha,
        ];
    });
});

Route::get('/posiciones', function () {
    return Posicion::with('seleccion')
        ->orderByDesc('puntos')
        ->get()
        ->map(function ($p) {
            return [
                'nombre' => $p->seleccion->nombre,
                'pj' => $p->jugados,
                'pg' => $p->ganados,
                'pe' => $p->empatados,
                'pp' => $p->perdidos,
                'puntos' => $p->puntos,
                'gf' => $p->goles_favor,
                'gc' => $p->goles_contra,
            ];
        });
});

