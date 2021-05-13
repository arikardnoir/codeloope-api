<?php

namespace App\Repository\V1\MomInfo;

use App\Models\MomInfo;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class MomInfoRepository extends BaseRepository
{

    public function __construct(MomInfo $momInfo)
    {
        parent::__construct($momInfo);
    }

    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $momInfo = $this->obj->create($attributes);
            DB::commit();
            return $momInfo;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $momInfo = $this->obj->where('student_id', $id)->first();
            if ($momInfo) {
                $momInfo=$momInfo->updateOrCreate([
                    'student_id' => $id,
                        ], $attributes);
            }
            DB::commit();
            return (object) $momInfo;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->where('id', $id)
                        ->first();
    }

    public function showMomInfoID(int $id): object
    {
        return (object) $this->obj
                        ->where('student_id', $id)
                        ->first();
    }

}
