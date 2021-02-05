<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['ques_id', 'option_id', 'check'];

    public static function currect_answer_check($ques_id, $option_id)
    {
        $check_key = $ques_id . "." . $option_id;
        $available_or_not = Answer::where('check', $check_key)->first();
        if ($available_or_not) {
            return true;
        } else {
            return false;
        }
    }
}