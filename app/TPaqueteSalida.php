<?php
// admin-universe-6/app/TPaqueteSalida.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TPaqueteSalida extends Model
{
    protected $table = 'tpaquetes_salidas';

    protected $fillable = [
        'idpaquetes',
        'departure_date',
        'label',
        'seats_total',
        'seats_available',
        'price_from',
        'status',
        'sort_order',
    ];

    public function paquete()
    {
        return $this->belongsTo(TPaquete::class, 'idpaquetes');
    }
}
