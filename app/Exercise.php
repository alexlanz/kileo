<?php namespace Kileo;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model {
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'exercises';

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['class_id', 'name','description', 'active'];

    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = [];

    /**
    * Get schoolClass of this exercise
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function schoolClass()
    {
        return $this->belongsTo('Kileo\SchoolClass');
    }
}
