<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    protected $fillable = [
        'name', 'birthday', 'class', 'user_id'
    ];
    protected $visible = [
        'id','name', 'birthday', 'class', 'user_id', 'address', 'momInfo'
    ];

    public function address(){
        return $this->hasOne(Address::class,'student_id', 'id');
    }


    public function momInfo(){
        return $this->hasOne(MomInfo::class,'student_id', 'id');
    }
}
