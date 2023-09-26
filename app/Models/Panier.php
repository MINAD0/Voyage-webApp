<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Panier extends Model
{
    public function voyage()
    {
        return $this->belongsTo( Voyage::class, 'voyage_id');
    }
    public function user()
    {
        return $this->belongsTo( User::class, 'user_id');
    }
}
