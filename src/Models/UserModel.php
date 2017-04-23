<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class UserModel extends Model
{
    protected $table 		= 'users';
    protected $primaryKey 	= 'id';
    protected $fillable		= ['name', 'username', 'email', 'password'];
    public $timestamps		= true;
}