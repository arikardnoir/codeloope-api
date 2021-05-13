<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'cep', 'street', 'number', 'building_complement', 'neighborhood', 'city', 'state', 'student_id'
    ];
    protected $visible = [
        'id', 'cep', 'street', 'number', 'building_complement', 'neighborhood', 'city', 'state', 'student_id', 'student'
    ];

    public function student(){
        return $this->hasOne(Student::class,'student_id','id');
    }
}
