<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DateDisponibility extends Model
{
    
    public function voyage()
    {
        return $this->belongsTo( Voyage::class, 'id');
    }
    public function hotel()
    {
        return $this->belongsTo( Hotel::class, 'id');
    }
}
