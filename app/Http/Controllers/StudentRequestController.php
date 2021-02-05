<?php

namespace App\Http\Controllers;

use App\StudentRequest;
use Illuminate\Http\Request;

class StudentRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = explode("sep", $request->teachers_id)[0];
        $exam = explode("sep", $request->teachers_id)[1];
        $check = StudentRequest::where('student_id', auth()->user()->id)->where('teacher_id', $teacher)->where('exam_id', $exam)->first();
        if ($check) {
            $request->session()->flash('errors', 'You already send request to this course');
            return redirect()->back();
        }
        $send_req = new StudentRequest();
        $send_req->student_id = auth()->user()->id; //Dtaa minig
        $send_req->teacher_id = explode("sep", $request->teachers_id)[0]; //CSE-4802
        $send_req->course_id = $request->course_id; //CSE-4802
        $send_req->exam_id = explode("sep", $request->teachers_id)[1];
        $send_req->save();
        $request->session()->flash('success', 'successfully request sent!!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentRequest  $studentRequest
     * @return \Illuminate\Http\Response
     */
    public function show(StudentRequest $studentRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentRequest  $studentRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentRequest $studentRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentRequest  $studentRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentRequest $studentRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentRequest  $studentRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentRequest $studentRequest)
    {
        //
    }
}