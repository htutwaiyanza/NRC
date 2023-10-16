<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NrcPost extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function nrc2(){
        return $this->belongsTo(Nrc2::class);
}
public function post(){
    return $this->hasMany(Employee::class);
}

}
