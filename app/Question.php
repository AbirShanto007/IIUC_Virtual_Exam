<?php

namespace App;

use App\Option;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function options_list()
    {
        return $this->hasMany(Option::class, 'ques_id', 'id');
    }
}