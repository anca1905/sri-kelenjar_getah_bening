<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    protected $primaryKey = 'id_admin';
    protected $fillable = ['username', 'password', 'role'];
    protected $hidden = ['password'];

    // Use 'username' as the auth credential
    public function getAuthIdentifierName()
    {
        return 'username';
    }
}