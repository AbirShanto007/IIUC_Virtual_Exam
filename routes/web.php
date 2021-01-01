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
    Route::get('/exam/create', 'ExamController@create')->name('exam.create');
    Route::get('/exam/show_current_exam', 'ExamController@show_current_exam')->name('exam.show_current_exam');
    Route::post('/exam/store', 'ExamController@store')->name('exam.store');
    Route::get('/exam/question/{exam_id}', 'ExamController@show_exam_question')->name('show_exam_question');
    Route::post('/student_answer_submit', 'StudentSubmittedAnswerController@store')->name('student_answer_submit');
    Route::get('/see_result', 'StudentSubmittedAnswerController@see_result_marks')->name('see_result_marks');
});


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');


// Route::get('/irfan','StudentController@index');
// Route::get('/irfan_chy','StudentController@shanto');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');