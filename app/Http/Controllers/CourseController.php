<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Course;
use App\StudentRequest;
use Illuminate\Http\Request;

//--- Eluquent ORM ----
class CourseController extends Controller
{

    public function index()
    {
        $req = StudentRequest::where('student_id', auth()->user()->id)->where('status', 1)->get();
        return view('index', [
            'req' => $req
        ]);
    }


    public function create()
    {
        return view('test.create');
    }


    public function store(Request $request)
    {
        $course = new Course();
        $course->course_title = $request->title; //Dtaa minig
        $course->course_code = $request->code; //CSE-4802
        $course->credit = $request->credit; // 4
        $course->save();

        return redirect()->route('course_all');
    }


    public function show($id)
    {
        $course = Course::find($id);  //1

        return view('show', compact('course'));
    }


    public function edit($id)
    {
        $course = Course::find($id);
        return view('edit', compact('course'));
    }


    public function update(Request $request, $id)
    {
        $course = Course::find($id); //1
        $course->course_title = $request->title; //Dat Structure
        $course->course_code = $request->code; //CSE-4808
        $course->credit = $request->credit; // 4
        $course->update();

        return redirect()->route('course_all');
    }


    public function delete($id)
    {
        $course = Course::find($id); //1
        $course->delete();

        return redirect()->route('course_all');
    }
}