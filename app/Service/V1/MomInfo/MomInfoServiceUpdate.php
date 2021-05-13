<?php

namespace App\Service\V1\MomInfo;

use Illuminate\Http\Request;
use App\Repository\V1\MomInfo\MomInfoRepository;
use Validator;

class MomInfoServiceUpdate
{
    protected $momInfoRepository;

    public function __construct(
        MomInfoRepository $momInfoRepository
    )
    {
        $this->momInfoRepository = $momInfoRepository;
    }

    public function update($id, $request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $momInfo = $this->momInfoRepository->update($id, $attributes);

        if (!$momInfo) {
            return "Error updating mom Info.";
        }
    }

}
