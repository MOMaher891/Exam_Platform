<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class Observe extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;

    protected $table = "observes";
    protected $fillable = [
        'name',
        'national_id',
        'email',
        'password',
        'nationality',
        'code',
        'price',
        'phone',
        'center_id',
        'status',
        'job_title',
        'birth_date',
        'gender',
        'expire_date',
        'address',
        'img_personal',
        'img_national',
        'img_national_back',
        'img_passport',
        'img_certificate',
        'img_certificate_good_conduct',
    ];

    public $timestamps = false;
    use HasFactory;

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function observe_activities()
    {
        return $this->hasMany(\App\Models\ObserveActivity::class, 'observe_id');
    }
    public function black_list()
    {
        return $this->hasOne(Black_lists::class, 'observe_id');
    }
}
