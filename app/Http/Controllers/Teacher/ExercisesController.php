<?php namespace Kileo\Http\Controllers\Teacher;

use Illuminate\Contracts\Auth\Guard;
use Kileo\Http\Controllers\Controller;
use Kileo\Http\Requests\ExerciseRequest;
use Kileo\Http\Requests\CreateExerciseRequest;
use Kileo\Models\SchoolClass;
use Kileo\Models\Exercise;
use DB;

class ExercisesController extends Controller {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The current user.
     *
     * @var Guard
     */
    protected $user;

    /**
     * Create a new controller instance.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;

        $this->middleware('auth');
        $this->middleware('teacher');

        $this->user = $this->auth->user();
    }
    
    private function getConcreteExerciseController($type, $class_id)
    {
        switch($type)
        {
            case "math":
                return new MathExerciseController($this->auth);
            default:
                abort(404, 'Exercise type does not exist.');
        }
        
        return redirect()->route('teacher.classes.exercises.show', SchoolClass::find($class));;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createExercise($class, $type)
    {        
        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        return view("teacher.exercises.$type.create", compact('schoolClass', 'type'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param ExerciseRequest $request
     * @param $class
     * @return Response
     */
    public function store(ExerciseRequest $request, $class)
    {
        $data = $request->only('id','name','description','active', 'type');

        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $exercise = new Exercise();
        $exercise->name = $data['name'];
        $exercise->description = $data['description'];
        $exercise->active = $data['active'] == 1 ? true : false;
        $exercise->type = 'math';
        $exercise->schoolClass()->associate($schoolClass);
        
        $controller = $this->getConcreteExerciseController($data['type'], $schoolClass->id);
        
        // Start transaction for saving base-exercise as well as concrete exercise
        DB::beginTransaction();
        
        try
        {
            $exercise->save();
            $result = $controller->store($request, $class, $exercise);    
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        
        // now commit transaction
        DB::commit();
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $class
     * @param $exercise
     * @return Response
     */
    public function edit($class, $exercise)
    {
        $schoolClass = SchoolClass::where('id', $class)->where('user_id', $this->user->id)->first();

        if ( ! $schoolClass)
        {
            abort(404, 'School class not found.');
        }

        $exercise = Exercise::where('id', $exercise)->where('school_class_id', $class)->first();

        if ( ! $exercise)
        {
            abort(404, 'Exercise for this class not found.');
        }
        
        $baseexercise = $exercise;
        $exercise = $this->getConcreteExerciseController($exercise->type, $schoolClass->id)->findConcreteExercise($exercise->id);

        return view("teacher.exercises.$baseexercise->type.edit", compact('schoolClass', array('baseexercise', 'exercise')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExerciseRequest $request
     * @param $class
     * @param $exercise
     * @return Response
     */
    public function update(ExerciseRequest $request, $class, $exercise)
    {
        $data = $request->only('name','description','active');
        

        $exercise = Exercise::where('id', $exercise)->where('school_class_id', $class)->first();

        if ( ! $exercise)
        {
            abort(404, 'Exercise for this class not found.');
        }

        $exercise->name = $data['name'];
        $exercise->description = $data['description'];
        $exercise->active = $data['active'] == 1 ? true : false;
        
        $controller = $this->getConcreteExerciseController($exercise->type, $class);
        
        // Start transaction for saving base-exercise as well as concrete exercise
        DB::beginTransaction();
        
        try
        {
            $exercise->save();
            $result = $controller->update($request, $class, $exercise);    
        }
        catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
        
        // now commit transaction
        DB::commit();
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $class
     * @param $exercise
     * @return Response
     */
    public function destroy($class, $exercise)
    {
        $exercise_id = $exercise;
        $exercise = Exercise::where('id', $exercise)->where('school_class_id', $class)->first();

        if ( ! $exercise)
        {
            abort(404, 'Exercise for this class not found.');
        }

        $exercise->delete();
        
        return redirect()->route('teacher.classes.exercises.show', $class);
    }
}