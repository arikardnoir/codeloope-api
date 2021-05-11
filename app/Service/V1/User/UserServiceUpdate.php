<?php

namespace App\Service\V1\User;

use Illuminate\Http\Request;
use App\Repository\V1\User\UserRepository;
use function bcrypt;
use Validator;

class UserServiceUpdate
{

    use Traits\RuleTrait;

    protected $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();

        $validator = Validator::make($attributes, $this->rules($id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        $attributes['password'] = bcrypt($attributes['password']);
        return $this->userRepository->update($id, $attributes);
    }

}
