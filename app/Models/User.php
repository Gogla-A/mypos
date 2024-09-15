<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\HasRolesAndPermissions;
use Laratrust\Traits\LaratrustUserTrait;


class User extends Authenticatable
{
//    use LaratrustUserTrait;
    use Notifiable;
    use HasRolesAndPermissions;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     *

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'image'
    ];

    protected $appends = ['image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // Define the attachRole method
    public function attachRole($role, $userType = 'default_type')
    {
        if (is_string($role)) {
            // Find the role by name if it's passed as a string
            $role = Role::where('name', $role)->firstOrFail();
        }

        // Attach the role to the user
        return $this->roles()->attach($role, ['user_type' => $userType]);
    }
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->where('name', $role)->exists();
        }

        return $this->roles()->where('id', $role->id)->exists();
    }


    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get first name

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);

    }//end of get last name

    public function getImagePathAttribute()
    {
        return asset('uploads/user_images/' . $this->image);

    }//end of get image path
//    public static function create(array $array)
//    {
//    }


}//end of model
