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
        'expire',
        'price'
    ];
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getExpire($query){
        return $query->expire == 0 ? 'Active' :'Expired';
    }
}
