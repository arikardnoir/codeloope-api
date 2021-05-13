<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MomInfo extends Model
{
    protected $fillable = [
        'mom_name', 'cpf', 'payment_date', 'student_id'
    ];
    protected $visible = [
        'id','mom_name', 'cpf', 'payment_date', 'student_id', 'student'
    ];

    public function student(){
        return $this->hasOne(Student::class,'student_id','id');
    }
}
