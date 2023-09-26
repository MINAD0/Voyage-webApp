<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pay extends Model
{
    public function pay()
    {
        return $this->belongsTo( Pay::class, 'pays_id');
    }
}
