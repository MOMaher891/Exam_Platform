<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function exam_time()
    {
        return $this->hasMany(ExamTime::class);
    }
}
