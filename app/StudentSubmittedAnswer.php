<?php

namespace App;

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
}