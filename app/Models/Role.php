<?php

namespace App\Models;

use Laratrust\Models\Role as RoleModel;

class Role extends RoleModel
{
    protected $fillable = ['name'];

    // Define the many-to-many relationship with users
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
