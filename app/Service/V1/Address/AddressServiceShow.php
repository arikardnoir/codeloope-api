<?php

namespace App\Service\V1\Address;

use App\Repository\V1\Address\AddressRepository;

class AddressServiceShow
{

    protected $addressRepository;

    public function __construct(AddressRepository $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    public function show(int $id)
    {
        return $this->addressRepository->show($id);
    }

}
