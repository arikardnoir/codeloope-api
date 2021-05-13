<?php

namespace App\Service\V1\Address;

use Illuminate\Http\Request;
use App\Repository\V1\Address\addressRepository;
use Validator;

class AddressServiceUpdate
{
    protected $addressRepository;

    public function __construct(
        AddressRepository $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    public function update($id, $request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $address = $this->addressRepository->update($id, $attributes);

        if (!$address) {
            return "Error updating Address";
        }
    }

}
