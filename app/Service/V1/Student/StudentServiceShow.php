<?php

namespace App\Service\V1\Student;

use App\Repository\V1\Student\StudentRepository;

class StudentServiceShow
{

    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository
    )
    {
        $this->studentRepository = $studentRepository;
    }

    public function showAll()
    {
        return $this->studentRepository->showAll();
    }

    public function show(int $id)
    {
        return $this->studentRepository->show($id);
    }

}
