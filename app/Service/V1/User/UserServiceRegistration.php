<?php

namespace App\Service\V1\User;

use App\Repository\V1\User\UserRepository;
use function bcrypt;
use Validator;

class UserServiceRegistration
{

    use Traits\RuleTrait;

    protected $userRepositor;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

         $validator = Validator::make($attributes, $this->rules());

         if ($validator->fails()) {
             return $validator->errors();
         }

        $attributes['password'] = bcrypt($attributes['password']);
        $user = $this->userRepository->save($attributes);
        return $user?$user:'unidentified user';
    }

}
