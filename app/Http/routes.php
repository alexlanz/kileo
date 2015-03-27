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

Route::get('/teacher', array('as' => 'teacher.index', 'uses' => 'TeacherController@index'));
Route::get('/teacher/classes/create', array('as' => 'teacher.classes.create', 'uses' => 'TeacherController@createClass'));
Route::get('/teacher/classes/{id}/edit', array('as' => 'teacher.classes.edit', 'uses' => 'TeacherController@editClass'));
Route::post('/teacher/classes', array('as' => 'teacher.classes.store', 'uses' => 'TeacherController@storeClass'));
Route::get('/teacher/classes/{id}/remove', array('as' => 'teacher.classes.remove', 'uses' => 'TeacherController@removeClass'));


/*
|--------------------------------------------------------------------------
| Pupil Controllers
|--------------------------------------------------------------------------
*/

Route::get('/pupil', array('as' => 'pupil.index', 'uses' => 'PupilController@index'));