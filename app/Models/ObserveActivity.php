<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObserveActivity extends Model
{
    use HasFactory;
    protected $fillable =[
        'observe_id',
        'exam_time_id',
        'is_come'
    ];

}
