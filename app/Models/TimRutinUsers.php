<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimRutinUsers extends Model
{
    protected $table = 'tim_rutin_user';

    protected $fillable = ['tim_rutin_id', 'user_id'];

    public function timSaya()
    {
        return $this->belongsTo(TimRutin::class);
    }
}
