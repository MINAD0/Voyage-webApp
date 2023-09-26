<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Hotel extends Model
{
    protected $fillable = [
        'nom_hotel',
        'adresse_hotel',
        'image_hotel',
        'ville_id',
        'type',
        'rating',
        'type_chambre',
        'tarif',
        // Add other attributes here
    ];

    public function ville(){
        return $this->belongsTo(Ville::class, 'ville_id');
    }

    public function dateDisponibility(){
        return $this->hasMany( DateDisponibility::class, 'hotel_id');
    }

    public function chambre(){
        return $this->hasMany( Chambre::class, 'hotel_id');
    }
}
