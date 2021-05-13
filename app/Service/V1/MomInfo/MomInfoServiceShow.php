<?php

namespace App\Service\V1\MomInfo;

use App\Repository\V1\MomInfo\MomInfoRepository;

class MomInfoServiceShow
{

    protected $momInfoRepository;

    public function __construct(MomInfoRepository $momInfoRepository
    )
    {
        $this->momInfoRepository = $momInfoRepository;
    }

    public function show(int $id)
    {
        return $this->momInfoRepository->show($id);
    }

}
