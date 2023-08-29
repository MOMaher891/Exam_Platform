<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamTime;
use App\Models\Observe;

class ObserveActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'observe_id',
        'exam_time_id',
        'is_come'
    ];

    public function exam_time()
    {
        return $this->belongsTo(ExamTime::class, 'exam_time_id');
    }


    public function observes()
    {
        return $this->belongsTo(Observe::class, 'observe_id');
    }
    public function examTime()
    {
        return $this->belongsTo(ExamTime::class, 'exam_time_id');
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['is_come'])) {
            $query->where('is_come', $request['is_come']);
        }
    }
}
