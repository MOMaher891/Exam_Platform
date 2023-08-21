<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'category_id',
        'date',
        'show_date',
        'expire',
        'price',
        'num_of_hours',
        'type',
        'centers'
    ];
    
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getExpire($query){
        return $query->expire == 0 ? 'Active' :'Expired';
    }

    public function examCenter()
    {
        return $this->hasMany(ExamCenter::class);
    }

}
