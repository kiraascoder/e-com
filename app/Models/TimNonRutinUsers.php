<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimNonRutinUsers extends Model
{
    protected $table = 'tim_non_rutin_user';

    protected $fillable = ['tim_non_rutin_id', 'user_id'];

    public function timSaya()
    {
        return $this->belongsTo(TimNonRutin::class);
    }
}
