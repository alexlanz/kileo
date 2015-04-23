<?php

Route::get('/', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| Authentication Controllers
|--------------------------------------------------------------------------
*/

Route::get('/login', array('as' => 'login.show', 'uses' => 'AuthController@getLogin'));
Route::post('/login', array('as' => 'login.post', 'uses' => 'AuthController@postLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

/*
|--------------------------------------------------------------------------
| Teacher Controllers
|--------------------------------------------------------------------------
*/

Route::get('/teacher', array('as' => 'teacher.index', 'uses' => 'Teacher\TeacherController@index'));
Route::get('/teacher/classes/create', array('as' => 'teacher.classes.create', 'uses' => 'Teacher\SchoolClassController@create'));
Route::get('/teacher/classes/{id}/edit', array('as' => 'teacher.classes.edit', 'uses' => 'Teacher\SchoolClassController@edit'));
Route::post('/teacher/classes', array('as' => 'teacher.classes.store', 'uses' => 'Teacher\SchoolClassController@store'));
Route::get('/teacher/classes/{id}/remove', array('as' => 'teacher.classes.remove', 'uses' => 'Teacher\SchoolClassController@remove'));


/*
|--------------------------------------------------------------------------
| Pupil Controllers
|--------------------------------------------------------------------------
*/

Route::get('/pupil', array('as' => 'pupil.index', 'uses' => 'Pupil\PupilController@index'));