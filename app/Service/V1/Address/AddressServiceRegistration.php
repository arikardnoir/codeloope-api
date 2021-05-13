<?php

namespace App\Service\V1\Address;

use App\Repository\V1\Address\AddressRepository;
use Validator;

class AddressServiceRegistration
{

    protected $addressRepositor;

    public function __construct(
        AddressRepository $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $address = $this->addressRepository->save($attributes);

        if (!$address) {
            return "Error Saving Address";
        }
    }

}
