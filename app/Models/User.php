<?php namespace Kileo\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract {

	use Authenticatable;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'username', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * Encrypts the password and sets it.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get classes of this teacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolClasses()
    {
        return $this->hasMany('Kileo\Models\SchoolClass');
    }

    /**
     * Get class of this pupil
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schoolClass()
    {
        return $this->belongsTo('Kileo\Models\SchoolClass');
    }

}
