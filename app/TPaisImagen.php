<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPaisImagen extends Model
{
    protected $table = "tpaisesimagen";

    public function pais()
    {
        return $this->belongsTo(TPais::class, 'idpais');
    }

}
