<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
    public $timestamps = false;
    protected $table = 'resultados';

    public function local() {
        return $this->belongsTo(Seleccion::class, 'local_id');
    }

    public function visitante() {
        return $this->belongsTo(Seleccion::class, 'visitante_id');
    }
}
