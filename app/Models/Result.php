<?php namespace Kileo\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model {

    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'results';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['exercise_id', 'user_id', 'num_of_results', 'correct_results'];

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = [];

    /**
    * Get exercise of this result
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function exercise()
    {
        return $this->belongsTo('Kileo\Models\Exercise');
    }

    /**
     * Get user of this result
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Kileo\Models\User');
    }

}