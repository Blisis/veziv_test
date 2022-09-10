<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public const OFFICE_HOURS = [
        '09:00:00',
        '09:30:00',
        '10:00:00',
        '10:30:00',
        '11:00:00',
        '11:30:00',
        '12:00:00',
//        '12:30:00',
//        '13:00:00',

        '15:30:00',
        '16:00:00',
        '16:30:00',
        '17:00:00',
        '17:30:00',
        '18:00:00',
        '18:30:00',
        '19:00:00',
        '19:30:00',
        '20:00:00',
//        '20:30:00',
//        '21:00:00',
    ];

    protected $fillable = [
        'user_id',
        'date',
        'hour',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}


