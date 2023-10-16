<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $guarded = [

    ];

    protected $casts = [
        'education' => 'json',
        'working' => 'json',
        'contact_adress'=>'json'
    ];
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }
    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }
    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function blood_type()
    {
        return $this->belongsTo(BloodType::class);
    }
    public function martial_status()
    {
        return $this->belongsTo(MartialStatus::class);
    }
    public function races()
    {
        return $this->belongsTo(Race::class);
    }

    public function nrc2()
    {
        return $this->belongsTo(Nrc2::class);
    }

    public function nrc1()
    {
        return $this->belongsTo(Nrc1::class);
    }

    public function nrc_posts()
    {
        return $this->belongsTo(NrcPost::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class);
    }
    public function workings()
    {
        return $this->hasMany(Working::class);
    }
    }


