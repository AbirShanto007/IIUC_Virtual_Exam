<?php

namespace App;

use App\Answer;
use App\Question;
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
        $total_marks = 0;
        $all_submitted_list = StudentSubmittedAnswer::where('std_id', $std_id)->where('xm_id', $exam_id)->get();
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
        return $total_marks;
    }
}