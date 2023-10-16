<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nrc1 extends Model
{
    use HasFactory;
    protected $fillable =[
        'name'
    ];

    public function post(){
        return $this->hasMany(Employee::class);
    }

}
