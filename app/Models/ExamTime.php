<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamTime extends Model
{
    use HasFactory;
    protected $fillable= [
        'exam_id',
        'center_id',
        'from',
        'to',
        'num_of_observe',
        'is_done',
        'shift'
    ];

    public function center()
    {
        return $this->belongsTo(Center::class,'center_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }

    public function observeActivity()
    {
        return $this->hasMany(ObserveActivity::class);
    }
}
