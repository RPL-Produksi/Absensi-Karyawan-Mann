<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasUuids;

    protected $fillable = [
        'date',
        'time_in',
        'time_out',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
