<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Black_lists extends Model
{
    protected $table = 'black_lists';
    protected $fillable = ['observe_id', 'center_id'];
    public $timestamps = false;
    use HasFactory;
}
