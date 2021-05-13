<?php

namespace App\Service\V1\Student;

use App\Repository\V1\Student\StudentRepository;
use App\Service\V1\Address\AddressServiceRegistration;
use App\Service\V1\MomInfo\MomInfoServiceRegistration;
use Validator;

class StudentServiceRegistration
{

    use Traits\RuleTrait;
    use \App\Service\Traits\VerifyCnpjOrCpfTrait;

    protected $studentRepositor;
    protected $addressServiceRegistration;
    protected $momInfoServiceRegistration;

    public function __construct(
        StudentRepository $studentRepository,
        AddressServiceRegistration $addressServiceRegistration,
        MomInfoServiceRegistration $momInfoServiceRegistration
    )
    {
        $this->studentRepository = $studentRepository;
        $this->addressServiceRegistration = $addressServiceRegistration;
        $this->momInfoServiceRegistration = $momInfoServiceRegistration;
    }

    public function store($request)
    {
        $attributes = null;
        if (is_object($request)) {
            $attributes = $request->all();
        } else {
            $attributes = $request;
        }

        $validator = Validator::make($attributes, $this->rules());

         if ($validator->fails()) {
             return $validator->errors();
         }

        $attributes['cpf'] = preg_replace('/[^0-9]/', '', (string) $attributes['cpf']);

        if (!$this->cnpjCpf($attributes['cpf'])) {
            return "cpf invalid";
        }

        $attributes['user_id'] = auth()->user()->id;
        $student = $this->studentRepository->save($attributes);
        if ($student) {
            $attributes['student_id'] = $student->id;

            $this->addressServiceRegistration->store($attributes);
            $this->momInfoServiceRegistration->store($attributes);
        }

        return $student?$student:'unidentified student';
    }

}
