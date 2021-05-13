<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Service\V1\Student\StudentServiceRegistration;
use App\Service\V1\Student\StudentServiceShow;
use App\Http\Controllers\Controller;
use App\Service\V1\Student\StudentServiceUpdate;


class StudentController extends Controller
{

    protected $studentServiceRegistration;
    protected $studentServiceUpdate;
    protected $studentServiceShow;

    public function __construct(
        StudentServiceRegistration $studentServiceRegistration,
        StudentServiceUpdate $studentServiceUpdate,
        StudentServiceShow $studentServiceShow

    ) {
        $this->studentServiceShow = $studentServiceShow;
        $this->studentServiceUpdate = $studentServiceUpdate;
        $this->studentServiceRegistration = $studentServiceRegistration;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = $this->studentServiceShow->showAll();

        return response()->json(['data' => $students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = $this->studentServiceRegistration->store($request);

        return response()->json(['data' => $student]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = $this->studentServiceShow->show($id);

        return response()->json(['data' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $id, Request $request)
    {
        $student = $this->studentServiceUpdate->update($id, $request);

        return response()->json(['data' => $student]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
