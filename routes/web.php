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
            Route::post('/exam/negative/mark/{exam_id}/update', 'ExamController@negative_mark_update')->name('exam.negative_mark.update');
            Route::get('/see_request/{teacher_id}/{course_id}/{exam_id}', 'ExamController@see_student_list')->name('see_request');
            Route::get('/approved_student_marks/{teacher_id}/{course_id}/{exam_id}', 'ExamController@approved_student_marks')->name('approved_student_marks');
            Route::get('/student_submitted_answer/{std_id}/{course_id}/{exam_id}', 'ExamController@student_submitted_answer')->name('student_submitted_answer');
        });
    });
});

// Teacher credentials 
Route::get('/teacher_login', 'Teacher\Auth\LoginController@showLoginForm')->name('teacher.login');
Route::post('/teacher_login/store', 'Teacher\Auth\LoginController@login')->name('teacher.login.store');


// Adminpanel

Route::get('/admin_login', 'Admin_panel\Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin_login/store', 'Admin_panel\Auth\LoginController@login')->name('admin.login.store');

Route::post('/admin/logout', 'Admin_panel\Auth\LoginController@logout')->name('admin.logout');

Route::middleware(['admins_web'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::name('admin.')->group(function () {

            Route::get('/index', 'Admin_panel\AdminController@index')->name('index');


            Route::get('/courses', 'Admin_panel\AdminController@courses')->name('courses');
            Route::post('/courses_add', 'Admin_panel\AdminController@courses_add')->name('courses_add');
            Route::post('/course_del/delete/{id}', 'Admin_panel\AdminController@delete')->name('course_delete');

            Route::get('/grade_point', 'Admin_panel\AdminController@grade_point')->name('grade_point');
            Route::post('/grade_point_add', 'Admin_panel\AdminController@grade_point_add')->name('grade_point_add');
            Route::post('/grade_point_del/delete/{id}', 'Admin_panel\AdminController@grade_point_delete')->name('grade_point_delete');

            Route::get('/teacher_list', 'Admin_panel\AdminController@teachers_list')->name('teacher_list');
            //abir start
            Route::get('/student_list', 'Admin_panel\AdminController@students_list')->name('student_list');
            //abir end
        });
    });
});

Route::get('/teacher_register', 'Teacher\Auth\RegisterController@showRegistrationForm')->name('teacher.register');
Route::post('/teacher_register/store', 'Teacher\Auth\RegisterController@register')->name('teacher.register.store');
Route::post('/teacher/logout', 'Teacher\Auth\LoginController@logout')->name('teacher.logout');



/* Student/User login */
Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


// Route::get('/irfan','StudentController@index');
// Route::get('/irfan_chy','StudentController@shanto');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//http://poshsquares.com/iiuc-virtual-quiz/public/