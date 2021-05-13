<?php

namespace App\Service\V1\Student;

use Illuminate\Http\Request;
use App\Repository\V1\student\StudentRepository;
use App\Repository\V1\MomInfo\MomInfoRepository;
use App\Service\V1\Address\AddressServiceUpdate;
use App\Service\V1\MomInfo\MomInfoServiceUpdate;
use Validator;

class StudentServiceUpdate
{
    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $studentRepository;
    protected $momInfoRepository;
    protected $addressServiceUpdate;
    protected $momInfoServiceUpdate;

    public function __construct(
        StudentRepository $studentRepository,
        momInfoRepository $momInfoRepository,
        AddressServiceUpdate $addressServiceUpdate,
        MomInfoServiceUpdate $momInfoServiceUpdate
    )
    {
        $this->studentRepository = $studentRepository;
        $this->momInfoRepository = $momInfoRepository;
        $this->addressServiceUpdate = $addressServiceUpdate;
        $this->momInfoServiceUpdate = $momInfoServiceUpdate;
    }

    public function update(int $id, Request $request)
    {
        $attributes = $request->all();

        $momInfoID = $this->momInfoRepository->showMomInfoID($id);

        $validator = Validator::make($attributes, $this->rules($momInfoID->id));

        if ($validator->fails()) {
            return $validator->errors();
        }

        $attributes['cpf'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf']);

        if (!$this->cnpjCpf($attributes['cpf'])) {
            return "cpf invalid";
        }

        $student = $this->studentRepository->update($id, $attributes);
        if ($student) {
            $attributes['student_id'] = $student->id;

            $this->addressServiceUpdate->update($id, $attributes);
            $this->momInfoServiceUpdate->update($id, $attributes);
        }

        return $student;
    }

}
