<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Chambre extends Model
{
    public function hotel()
    {
        return $this->belongsTo( Hotel::class, 'hotel_id');
    }
}
