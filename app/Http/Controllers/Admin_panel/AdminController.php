<?php

namespace App\Http\Controllers\Admin_panel;

use App\User;
use App\Course;
use App\Teacher;
use App\GradePoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin_panel.login');
    }
    
    public function index()
    {
        return view('admin_panel.index');
    }

    public function courses()
    {
        $courses = Course::orderBy('id', 'DESC')->paginate(5);
        return view('admin_panel.courses', with([
            'courses' => $courses
        ]));
    }
    public function courses_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_code' => 'required|unique:courses',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->except('_token');
        Course::create($data);
        return redirect()
            ->back()
            ->withSuccess("Course Successfully added");
    }

    public function delete($id)
    {
        $course = Course::find($id); //1
        $course->delete();
        return redirect()
            ->back()
            ->withSuccess("Course Successfully deleted");
    }
    public function grade_point()
    {
        $grade_point = GradePoint::orderBy('id', 'DESC')->paginate(5);
        return view('admin_panel.grade_point', with([
            'grade_point' => $grade_point
        ]));
    }
    public function grade_point_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'grade' => 'required|unique:grade_points',
            'grade_point' => 'required|unique:grade_points',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = $request->except('_token');
        GradePoint::create($data);
        return redirect()
            ->back()
            ->withSuccess("Grade Successfully added");
    }

    public function grade_point_delete($id)
    {
        $gradepoint = GradePoint::find($id); //1
        $gradepoint->delete();
        return redirect()
            ->back()
            ->withSuccess("Grade Point Successfully deleted");
    }

    public function teachers_list()
    {
        $teacher = Teacher::orderBy('id', 'DESC')->paginate(5);
        return view('admin_panel.teachers', with([
            'teacher' => $teacher
        ]));
    }

    public function students_list()
    {
        $students = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin_panel.students', with([
            'students' => $students
        ]));
    }
}