<?php

namespace App\Repository\V1\Student;

use App\Models\Student;
use App\Repository\V1\BaseRepository;
use Illuminate\Support\Facades\DB;

class StudentRepository extends BaseRepository
{

    public function __construct(Student $student)
    {
        parent::__construct($student);
    }

    public function save(array $attributes): object
    {
        DB::beginTransaction();
        try {
            $student = $this->obj->create($attributes);
            DB::commit();
            return $student;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }

    public function update(int $id, array $attributes): object
    {
        DB::beginTransaction();
        try {
            $student = $this->obj->find($id);
            if ($student) {
                $student=$student->updateOrCreate([
                    'id' => $id,
                        ], $attributes);
            }

            DB::commit();
            return (object) $student;
        } catch (Exception $ex) {
            DB::rollback();
            return $ex->getMessage();
        }
    }


    public function showAll(): object
    {
        return (object) $this->obj
                        ->with(['address'])
                        ->with(['momInfo'])
                        ->where('user_id', auth()->user()->id)->get();
    }

    public function show(int $id): object
    {
        return (object) $this->obj
                        ->with(['address'])
                        ->with(['momInfo'])
                        ->where('id', $id)
                        ->first();
    }

}
