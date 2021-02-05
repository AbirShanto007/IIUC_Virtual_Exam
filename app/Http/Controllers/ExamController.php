<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Answer;
use App\Course;
use App\Question;
use Carbon\Carbon;
use App\StudentRequest;
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

    public function exam_time_update(Request $request, $exam_id)
    {
        Exam::where([
            'id' => $exam_id
        ])->update([
            'xm_start_time' => $request->exam_start_time,
            'xm_end_time' => $request->exam_end_time,
        ]);
        $request->session()->flash('success', 'time update!');
        return redirect()->back();
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
    public function see_student_list($teacher_id, $course_id, $exam_id)
    {
        $exam_row = Exam::where('id', $exam_id)->first();
        $studentReq = StudentRequest::where('teacher_id', $teacher_id)->where('course_id', $course_id)->where('exam_id', $exam_id)->get();
        return view('teacher_panel.see_req')->with([
            'studentReq' => $studentReq,
            'exam_row' => $exam_row,
        ]);
    }
    public function approved_student_marks($teacher_id, $course_id, $exam_id)
    {
        $exam_row = Exam::where('id', $exam_id)->first();
        $studentReq = StudentRequest::where('teacher_id', $teacher_id)->where('course_id', $course_id)->where('exam_id', $exam_id)->where('status', 1)->get();
        return view('teacher_panel.approved_student_marks')->with([
            'studentReq' => $studentReq,
            'exam_row' => $exam_row,
        ]);
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

    public function create_subject_exam()
    {
        $all_course = Course::all();
        return view('teacher_panel.subject_or_exam', [
            'all_course' => $all_course
        ]);
    }
    public function create_subject_exam_store(Request $request)
    {
        if (isset($request->active_or_not)) {
            Exam::where('xm_status', 1)->where('teacher_id', auth('teachers_web')->user()->id)->where('xm_course', $request->xm_course)->update(['xm_status' => 0]);
            $this->add_exam($request->all());
        } else {
            $this->add_exam($request->all());
        }

        $request->session()->flash('success', 'add successful!');
        return redirect()->back();
    }

    public function add_exam($request)
    {
        $request = json_decode(json_encode($request));
        $exam = new Exam();
        $exam->xm_status = isset($request->active_or_not) ? 1 : 0;
        $exam->xm_name = isset($request->subject_name) ? $request->subject_name : 0;
        $exam->xm_id = isset($request->subject_code) ? $request->subject_code : 0;
        $exam->teacher_id = auth('teachers_web')->user()->id;
        $exam->teacher_name = auth('teachers_web')->user()->name;
        $exam->xm_course =  isset($request->xm_course) ? $request->xm_course : 0;
        $exam->save();
    }

    public function show_exam_list()
    {
        $exams = Exam::where('teacher_id', '=', auth('teachers_web')->user()->id)->orderBy('xm_course')->get();
        return view('teacher_panel.show_exam_list')->with([
            'exams' => $exams
        ]);
    }

    public function set_exam_question(Exam $exam_id)
    {
        $questions = Question::with('options_list')->where('exam_id', $exam_id->id)->get();
        return view('teacher_panel.set_question')->with([
            'exam_info' => $exam_id,
            'questions' => $questions
        ]);
    }

    public function set_exam_question_store(Request $request, $exam_id)
    {
        // dd($request->all());
        $question = $this->set_q_for_exam($request->all(), $exam_id);
        $option = $this->set_op_for_question($request->all(), $question);
        $request->session()->flash('success', 'question successfully set!');
        return redirect()->back();
    }

    public function set_q_for_exam($request, $exam_id)
    {
        $request = json_decode(json_encode($request));
        $question = new Question();
        $question->ques_name = isset($request->question_detail) ? $request->question_detail : null;
        $question->ques_mark = isset($request->mark) ? $request->mark : 0;
        $question->exam_id = $exam_id;
        $question->save();
        return $question;
    }
    public function set_op_for_question($request, $question)
    {
        $request = json_decode(json_encode($request));

        $option_one =  $question->options_list()->create([
            'option_name' => $request->option_1
        ]);
        $option_two =  $question->options_list()->create([
            'option_name' => $request->option_2
        ]);
        $option_three =  $question->options_list()->create([
            'option_name' => $request->option_3
        ]);
        $option_four =  $question->options_list()->create([
            'option_name' => $request->option_4
        ]);


        if (isset($request->correct_ans)) {
            if ($request->correct_ans == 1) {
                return  $answer =  $this->set_currect_answer($question->id, $option_one->id);
            }
            if ($request->correct_ans == 2) {
                return  $answer =  $this->set_currect_answer($question->id, $option_two->id);
            }
            if ($request->correct_ans == 3) {
                return $answer =  $this->set_currect_answer($question->id, $option_three->id);
            }
            if ($request->correct_ans == 4) {
                return  $answer =  $this->set_currect_answer($question->id, $option_four->id);
            }
        }
    }

    public function set_currect_answer($question, $option)
    {
        $check_key = $question . "." . $option;
        Answer::where('check', $check_key)->delete();
        $answer = Answer::create([
            'ques_id' => $question,
            'option_id' => $option,
            'check' => $check_key
        ]);
        return $answer;
    }

    public function exam_status(Request $request)
    {
        if (isset($request->status)) {
            if ($request->status == 1) {
                Exam::where('xm_status', 1)->where('teacher_id', auth('teachers_web')->user()->id)->where('xm_course', $request->xm_course)->update(['xm_status' => 0]);

                Exam::where('id', $request->id)->update(['xm_status' => 1]);
                $request->session()->flash('success', 'exam successfully activate!');
                return redirect()->back();
            }
            if ($request->status == 0) {
                Exam::where('id', $request->id)->update(['xm_status' => 0]);
                $request->session()->flash('success', 'exam successfully deactivate!');
                return redirect()->back();
            }
        }
    }
    public function req_status(Request $request)
    {
        if (isset($request->status)) {
            if ($request->status == 1) {
                StudentRequest::where('id', $request->id)->update(['status' => 1]);
                $request->session()->flash('success', 'status successfully approved!');
                return redirect()->back();
            }
            if ($request->status == 0) {
                StudentRequest::where('id', $request->id)->update(['status' => 0]);
                $request->session()->flash('success', 'status not approve!');
                return redirect()->back();
            }
        }
    }
}