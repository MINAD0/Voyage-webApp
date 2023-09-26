<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Ville extends Model
{
    public function ville()
    {
        return $this->belongsTo( Ville::class, 'ville_id');
    }

    public function pay()
    {
        return $this->belongsTo( Pay::class, 'pays_id');
    }

    public function hotel(){
        return $this->hasMany( Hotel::class, 'ville_id');
    }
}
