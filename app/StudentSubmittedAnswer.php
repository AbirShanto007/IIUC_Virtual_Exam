<?php

namespace App;

use App\Exam;
use App\Answer;
use App\Question;
use App\GradePoint;
use Illuminate\Database\Eloquent\Model;

class StudentSubmittedAnswer extends Model
{
    public static function check_selected($std_id, $xm_id, $ques_id, $op_id)
    {
        $checked = StudentSubmittedAnswer::where('std_id', $std_id)->where('xm_id', $xm_id)->where('q_id', $ques_id)->where('op_id', $op_id)->first();
        if ($checked) {
            return true;
        } else {
            return false;
        }
    }

    public static function result($std_id, $exam_id)
    {
        $final_array = [];
        $wrong_final_array = [];
        $total_marks = 0;
        $total_exam_marks = 0;
        $total_wrong_exam_marks = 0;
        $total_exam_marks_grand = 0;
        $all_submitted_list = StudentSubmittedAnswer::where('std_id', $std_id)->where('xm_id', $exam_id)->get();
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
        foreach ($final_array as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_marks = $total_marks + $question->ques_mark;
        }
        foreach ($wrong_final_array as $key => $value) {
            $question = Question::where('id', $value)->first();
            $total_wrong_exam_marks = $total_wrong_exam_marks + $question->ques_mark;
        }
        $examdata = Exam::where('id',  $exam_id)->first();
        if ($total_wrong_exam_marks > 0) {
            if (isset($examdata->negativeMark)) {
                $total_marks = $total_marks - ($total_wrong_exam_marks * $examdata->negativeMark) / 100;
            }
        }
        $questions = Question::with('options_list')->where('exam_id',  $exam_id)->get();
        foreach ($questions as $key => $value1) {
            $question = Question::where('id', $value1->id)->first();
            $total_exam_marks_grand = $total_exam_marks_grand + $question->ques_mark;
        }
        $percentGrandMarks = ($total_exam_marks_grand > 0) ? round(($total_marks * 100) / $total_exam_marks_grand) : round(($total_marks * 100) / 1);
        $percentGrandMarks = (int)$percentGrandMarks;
        // dd((int)$percentGrandMarks);
        $gradePointInfo = GradePoint::where('starting_number', '<=', $percentGrandMarks)->where('ending_number', '>=', $percentGrandMarks)->first();
        return json_encode([
            'total_marks' => $total_marks,
            'gradePointInfo' => $gradePointInfo,
            'total_exam_marks_grand' => $total_exam_marks_grand,
        ]);
    }
}