<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function index()
    {
    }


    public function create()
    {
        return view('exam.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $exam_data = new Exam();
        $exam_data->xm_id = $request->exam_id; //Dtaa minig
        $exam_data->xm_name = $request->exam_name; //CSE-4802
        $exam_data->xm_start_time = $request->exam_start_time; //CSE-4802
        $exam_data->xm_end_time = $request->exam_end_time; //CSE-4802
        $exam_data->xm_status = 1; //CSE-4802
        $exam_data->xm_course = 1; // 4
        $exam_data->save();
        dd("done");
        // $exam_data->
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_current_exam(Request $request)
    {
        $exam_row = Exam::where('xm_course', $request->course_id)->where('xm_status', 1)->first();
        return view('exam.show_exam')->with([
            'exam_row' => $exam_row
        ]);
    }

    public function show_exam_question(Request $request, $exam_id)
    {
        $auth_student = Auth::id();
        $exam_row = Exam::where('id', $exam_id)->first();
        $current_time = Carbon::parse(Carbon::now());
        $start_time = Carbon::parse($exam_row->xm_start_time);
        $end_time = Carbon::parse($exam_row->xm_end_time);

        if (($current_time < $start_time)) {
            dd("Exam not start");
        }
        if (($current_time > $end_time)) {
            dd("Exam over");
        }

        if (($current_time >= $start_time) && ($current_time < $end_time)) {
            $ques_rows = Question::where('exam_id', $exam_id)->get();
            return view('question.show_ques')->with([
                'questions' => $ques_rows,
                'auth_student' => $auth_student,
            ]);
        } else {
            dd("Exam is over");
        }
    }
}