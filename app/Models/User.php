<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cpf_cnpj', 'email', 'phone', 'state', 'city','address','is_active','password','company_name','category_id','user_type_id'
    ];
    protected $visible = [
        'id', 'name', 'cpf_cnpj', 'email', 'phone', 'state', 'city','address','is_active','password','company_name','category_id','user_type_id','userType','product','category'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function userType(){
        return $this->hasOne(UserType::class,'id','user_type_id');
    }

    public function category(){
        return $this->hasOne(Category::class,'id','category_id');
    }

    public function product(){
        return $this->hasMany(Product::class,'user_id','id');
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}