<?php

namespace App;

use App\Exam;
use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class StudentRequest extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }
}