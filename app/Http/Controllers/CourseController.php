<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

//--- Eluquent ORM ----
class CourseController extends Controller
{

    public function index()
    {
        $all_course_list = Course::all(); //Assending

        // $all_course_list = Course::orderBy('id','ASC')->get(); //Assenenending
        // $all_course_list = Course::orderBy('course_title','DESC')->get(); //Desenending

        // return $all_course_list;

        return view('index', compact('all_course_list'));

        // return view('admin.pages.courses.index',compact('all_course_list'));
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