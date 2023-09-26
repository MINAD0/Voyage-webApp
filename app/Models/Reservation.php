<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Reservation extends Model
{
    public function voyage()
    {
        return $this->belongsTo( Voyage::class, 'voyage_id');
    }
    public function chambre()
    {
        return $this->belongsTo( Chambre::class, 'chambre_id');
    }
}
