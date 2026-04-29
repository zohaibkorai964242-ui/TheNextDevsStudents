<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'start_time',
        'date',
        'scanned_at',
    ];

    protected $dates = [
        'date',
        'scanned_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
