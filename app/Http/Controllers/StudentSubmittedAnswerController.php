<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
use App\Course;
use App\GradePoint;
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
        if (!isset($request->selected_ans)) {
            $request->session()->flash('error', 'Submitted answer can not be null');
            return redirect()->back();
        }
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
        $auth_student = Auth::id();
        $final_array = [];
        $wrong_final_array = [];
        $total_marks = 0;
        $total_exam_marks = 0;
        $total_wrong_exam_marks = 0;
        $total_exam_marks_grand = 0;
        $all_submitted_list = StudentSubmittedAnswer::where('std_id', request('stu'))->where('xm_id', request('exm_id'))->get();
        // dd($all_submitted_list);
        foreach ($all_submitted_list as $key => $each_list) {
            $all_answer_list = Answer::where('check', $each_list->check_submit)->first();
            if ($all_answer_list) {
                if ($all_answer_list->check == $each_list->check_submit) {
                    array_push($final_array, $all_answer_list->ques_id);
                } else {
                }
            } else {
                array_push($wrong_final_array, $each_list->q_id);
            }
        }

        $all_ques_list = [];
        $all_question_exam = Question::where('exam_id',  request('exm_id'))->get();
        foreach ($all_question_exam as $key => $each_list_ques) {
            array_push($all_ques_list, $each_list_ques->id);
        }
        foreach ($all_ques_list as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_exam_marks = $total_exam_marks + $question->ques_mark;
        }


        foreach ($final_array as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_marks = $total_marks + $question->ques_mark;
        }
        $examdata = Exam::where('id',  request('exm_id'))->first();
        foreach ($wrong_final_array as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_wrong_exam_marks = $total_wrong_exam_marks + $question->ques_mark;
        }
        if ($total_wrong_exam_marks > 0) {
            if (isset($examdata->negativeMark)) {
                $total_marks = $total_marks - ($total_wrong_exam_marks * $examdata->negativeMark) / 100;
            }
        }

        $questions = Question::with('options_list')->where('exam_id', request('exm_id'))->get();
        foreach ($questions as $key => $value1) {
            $question = Question::where('id', $value1->id)->first();
            $total_exam_marks_grand = $total_exam_marks_grand + $question->ques_mark;
        }
        $percentGrandMarks = round(($total_marks * 100) / $total_exam_marks_grand);
        $percentGrandMarks = (int)$percentGrandMarks;
        // dd((int)$percentGrandMarks);
        $gradePointInfo = GradePoint::where('starting_number', '<=', $percentGrandMarks)->where('ending_number', '>=', $percentGrandMarks)->first();
        // dd($gradePointInfo);
        // $grade_point = GradePoint::wher
        // dd($total_wrong_exam_marks);
        return view('final_result')->with([
            'total_marks' => $total_marks,
            'total_exam_marks_grand' => $total_exam_marks_grand,
            'questions' => $questions,
            'auth_student' => $auth_student,
            'gradePointInfo' => $gradePointInfo,
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