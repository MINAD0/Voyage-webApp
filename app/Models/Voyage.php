<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Voyage extends Model
{
    public function ville()
    {
        return $this->belongsTo( Ville::class, 'ville_id');
    }
    public function pay()
    {
        return $this->belongsTo( Pay::class, 'pays_id');
    }

    public function dateDisponibility(){
        return $this->hasMany( DateDisponibility::class, 'voyage_id');
    }
    public function avis(){
        return $this->hasMany( AvisVoyage::class, 'voyage_id');
    }
}
