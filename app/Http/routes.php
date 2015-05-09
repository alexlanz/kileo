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

Route::group(['prefix' => 'teacher'], function()
{
    Route::get('/', array('as' => 'teacher.index', 'uses' => 'Teacher\TeacherController@index'));

    Route::resource('classes', 'Teacher\SchoolClassController', ['except' => ['index']]);
    Route::resource('classes.pupils', 'Teacher\PupilsController', ['except' => ['index']]);
    Route::get('classes/{classes}/pupils/{pupils}/password', array('as' => 'teacher.classes.pupils.password.show', 'uses' => 'Teacher\PupilsController@showPassword'));
    Route::put('classes/{classes}/pupils/{pupils}/password', array('as' => 'teacher.classes.pupils.password.update', 'uses' => 'Teacher\PupilsController@changePassword'));
    
    // exercises
    Route::get('classes/{classes}/exercises', array('as' => 'teacher.classes.exercises.show', 'uses' => 'Teacher\SchoolClassController@showExercises'));
    Route::get('classes/{classes}/exercises/createExercise/{type}', array('as' => 'teacher.classes.exercises.createExercise', 'uses' => 'Teacher\ExercisesController@createExercise'));
    Route::resource('classes.exercises', 'Teacher\ExercisesController', ['except' => ['index']]);
});


/*Route::post('/teacher/classes', array('as' => 'teacher.classes.store', 'uses' => 'Teacher\SchoolClassController@store'));
Route::get('/teacher/classes/create', array('as' => 'teacher.classes.create', 'uses' => 'Teacher\SchoolClassController@create'));
Route::get('/teacher/classes/{id}', array('as' => 'teacher.classes.index', 'uses' => 'Teacher\SchoolClassController@index'));
Route::get('/teacher/classes/{id}/edit', array('as' => 'teacher.classes.edit', 'uses' => 'Teacher\SchoolClassController@edit'));
Route::get('/teacher/classes/{id}/remove', array('as' => 'teacher.classes.remove', 'uses' => 'Teacher\SchoolClassController@remove'));

Route::post('/teacher/classes/{classId}/pupils', array('as' => 'teacher.classes.pupils.store', 'uses' => 'Teacher\PupilsController@store'));
Route::get('/teacher/classes/{classId}/pupils', array('as' => 'teacher.classes.pupils.create', 'uses' => 'Teacher\PupilsController@create'));
Route::get('/teacher/classes/{classId}/pupils/{pupilId}/edit', array('as' => 'teacher.classes.pupils.edit', 'uses' => 'Teacher\PupilsController@edit'));
Route::get('/teacher/classes/{classId}/pupils/{pupilId}/remove', array('as' => 'teacher.classes.pupils.remove', 'uses' => 'Teacher\PupilsController@remove'));*/


/*
|--------------------------------------------------------------------------
| Pupil Controllers
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'pupil'], function()
{
    Route::get('/', array('as' => 'pupil.index', 'uses' => 'Pupil\PupilController@index'));
});