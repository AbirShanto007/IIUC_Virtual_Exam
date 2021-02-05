<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return view('admin.layouts.master');
});


Route::get('/dashboard', 'Abir\AdminController@dashboard')->name('dashboard');


Route::get('/course/create', 'CourseController@create')->name('course_create');
Route::post('/course/store', 'CourseController@store')->name('course_store');
Route::get('/course/show/{id}', 'CourseController@show')->name('course_show_by_id');
Route::get('/course/edit/{id}', 'CourseController@edit')->name('course_edit_by_id');
Route::post('/course/update/{id}', 'CourseController@update')->name('course_update_by_id');
Route::get('/course/delete/{id}', 'CourseController@delete')->name('course_delete_by_id');

Route::middleware(['auth'])->group(function () {
    Route::get('/course/list/frontend', 'CourseController@index')->name('course.frontend');

    Route::post('/exam/store', 'ExamController@store')->name('exam.store');
    Route::get('/exam/create', 'ExamController@create')->name('exam.create');

    //student routes
    Route::get('/exam/show_current_exam', 'ExamController@show_current_exam')->name('exam.show_current_exam');
    Route::get('/exam/question/{exam_id}', 'ExamController@show_exam_question')->name('show_exam_question');
    Route::post('/student_answer_submit', 'StudentSubmittedAnswerController@store')->name('student_answer_submit');
    Route::get('/see_result', 'StudentSubmittedAnswerController@see_result_marks')->name('see_result_marks');
    Route::get('/send_req', 'StudentSubmittedAnswerController@send_req')->name('send_req');
    Route::post('/send_req/store', 'StudentRequestController@store')->name('send_req.store');
    Route::get('/get_teacher_by_course_id/{course_id}', 'StudentSubmittedAnswerController@get_teacher_by_course_id');
});


//teacher panel
Route::middleware(['teachers_web'])->group(function () {
    Route::prefix('teacher')->group(function () {
        Route::name('teacher.')->group(function () {
            Route::get('/create_subject_exam', 'ExamController@create_subject_exam')->name('create_subject_exam');
            Route::get('/show_exam_list', 'ExamController@show_exam_list')->name('show_exam_list');
            Route::get('/{exam_id}/set_exam_question', 'ExamController@set_exam_question')->name('set_exam_question');
            Route::post('/{exam_id}/set_exam_question/store', 'ExamController@set_exam_question_store')->name('set_exam_question_store');
            Route::post('/create_subject_exam/store', 'ExamController@create_subject_exam_store')->name('create_subject_exam_store');
            Route::post('/status/store', 'ExamController@exam_status')->name('exam_status');
            Route::post('/req_status/store', 'ExamController@req_status')->name('req_status');
            Route::post('/exam/time/{exam_id}/update', 'ExamController@exam_time_update')->name('exam.time.update');
            Route::get('/see_request/{teacher_id}/{course_id}/{exam_id}', 'ExamController@see_student_list')->name('see_request');
            Route::get('/approved_student_marks/{teacher_id}/{course_id}/{exam_id}', 'ExamController@approved_student_marks')->name('approved_student_marks');
        });
    });
});

// Teacher credentials 
Route::get('/teacher_login', 'Teacher\Auth\LoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher_login/store', 'Teacher\Auth\LoginController@login')->name('teacher.login.store');

Route::get('/teacher_register', 'Teacher\Auth\RegisterController@showRegistrationForm')->name('teacher.register');
Route::post('/teacher_register/store', 'Teacher\Auth\RegisterController@register')->name('teacher.register.store');
Route::post('/teacher/logout', 'Teacher\Auth\LoginController@logout')->name('teacher.logout');




Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


// Route::get('/irfan','StudentController@index');
// Route::get('/irfan_chy','StudentController@shanto');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');