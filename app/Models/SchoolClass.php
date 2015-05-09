<?php namespace Kileo\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'school_classes';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['user_id', 'name'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];


    /**
     * Get teacher of this class
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher()
    {
        return $this->belongsTo('Kileo\Models\User', 'user_id');
    }

    /**
     * Get pupils of this school class
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pupils()
    {
        return $this->hasMany('Kileo\Models\User', 'school_class_id');
    }
    
    /**
     * Get pupils of this school class
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exercises()
    {
        return $this->hasMany('Kileo\Models\Exercise', 'school_class_id');
    }

}
