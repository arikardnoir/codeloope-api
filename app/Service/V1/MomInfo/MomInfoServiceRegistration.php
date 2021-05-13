<?php

namespace App\Service\V1\MomInfo;

use App\Repository\V1\MomInfo\MomInfoRepository;
use Validator;

class MomInfoServiceRegistration
{

    protected $momInfoRepositor;

    public function __construct(
        MomInfoRepository $momInfoRepository
    )
    {
        $this->momInfoRepository = $momInfoRepository;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $momInfo = $this->momInfoRepository->save($attributes);
        if (!$momInfo) {
            return "Error saving mom Info.";
        }
    }

}
