<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transcribe extends Model
{
    protected $fillable = [
        'user_id',
        'file_name',
        'result'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
