<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
use App\Course;
use App\Question;
use Illuminate\Http\Request;
use App\StudentSubmittedAnswer;
use Illuminate\Support\Facades\Auth;

class StudentSubmittedAnswerController extends Controller
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
        // dd(Auth::user());
        $check_question_answer_already_submit_or_not = Auth::id() . "." . $request->exam_id . "." . $request->ques_id;
        $check_submit_or_not = StudentSubmittedAnswer::where('check', $check_question_answer_already_submit_or_not)->first();
        // dd($check_submit_or_not);
        if ($check_submit_or_not) {
            $check_submit_or_not->op_id = $request->selected_ans;
            $check_submit_or_not->check_submit =  $request->ques_id . "." . $request->selected_ans; // 4
            $check_submit_or_not->save();
            return redirect()->back();
        } else {
            $studentSubmit = new StudentSubmittedAnswer();
            $studentSubmit->std_id = Auth::id(); //Dtaa minig
            $studentSubmit->xm_id = $request->exam_id; //CSE-4802
            $studentSubmit->q_id = $request->ques_id; // 4
            $studentSubmit->op_id = $request->selected_ans; // 4
            $studentSubmit->check_submit =  $request->ques_id . "." . $request->selected_ans; // 4
            $studentSubmit->check = Auth::id() . "." . $request->exam_id . "." . $request->ques_id;
            $studentSubmit->save();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentSubmittedAnswer  $studentSubmittedAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(StudentSubmittedAnswer $studentSubmittedAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentSubmittedAnswer  $studentSubmittedAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentSubmittedAnswer $studentSubmittedAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentSubmittedAnswer  $studentSubmittedAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentSubmittedAnswer $studentSubmittedAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentSubmittedAnswer  $studentSubmittedAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentSubmittedAnswer $studentSubmittedAnswer)
    {
        //
    }

    public function see_result_marks()
    {
        $final_array = [];
        $total_marks = 0;
        $all_submitted_list = StudentSubmittedAnswer::where('std_id', request('stu'))->where('xm_id', request('exm_id'))->get();
        foreach ($all_submitted_list as $key => $each_list) {
            $all_answer_list = Answer::where('check', $each_list->check_submit)->first();
            if ($all_answer_list) {
                if ($all_answer_list->check == $each_list->check_submit) {
                    array_push($final_array, $all_answer_list->ques_id);
                }
            }
        }


        foreach ($final_array as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_marks = $total_marks + $question->ques_mark;
        }
        return view('final_result')->with([
            'total_marks' => $total_marks
        ]);
    }

    public function send_req()
    {
        $all_course = Course::all();
        return view('student_panel.send_req', [
            'all_course' => $all_course
        ]);
    }

    public function get_teacher_by_course_id($course_id)
    {
        return $exam = Exam::where('xm_course', $course_id)->get();
    }
}