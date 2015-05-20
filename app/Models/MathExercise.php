<?php namespace Kileo\Models;

use Illuminate\Database\Eloquent\Model;

class MathExercise extends Model {    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'mathexercises';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['from','to', 'num_of_calculations', 'operation'];

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = [];
    
    // do not use timestamps because they are already in base-exercise
    public $timestamps = false;

    /**
    * Get exercise of this mathexercise
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function exercise()
    {
        return $this->belongsTo('Kileo\Models\Exercise', 'id');
    }
}
