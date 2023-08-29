<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'show_date',
        'expire',
        'paid',
        'price',
        'type',
        'centers'
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getExpire($query)
    {
        return $query->expire == 0 ? 'Active' : 'Expired';
    }

    public function exam_time()
    {
        return $this->hasMany(ExamTime::class);
    }

    public function scopeFilter($query, $request)
    {
        if (isset($request['expire'])) {
            $query->where('expire', $request['expire']);
        }

        if (isset($request['type'])) {
            $query->where('type', $request['type']);
        }
        if (isset($request['paid'])) {
            $query->where('paid', $request['paid']);
        }

        if (isset($request['date_from']) && isset($request['date_to'])) {
            $from = Carbon::parse($request['date_from']);
            $to = Carbon::parse($request['date_to']);
            $query->whereBetween('date', [$from, $to]);
        }
    }
}
