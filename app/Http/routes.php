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

/*
|--------------------------------------------------------------------------
| Pupil Controllers
|--------------------------------------------------------------------------
*/

Route::get('/pupil', array('as' => 'pupil.index', 'uses' => 'PupilController@index'));