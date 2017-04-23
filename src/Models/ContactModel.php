<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class ContactModel extends Model
{
    protected $table        = 'contacts';
    protected $primaryKey   = 'id';
    protected $fillable     = ['user_id', 'contact_user_id'];
    public $timestamps      = false;

    /**
    *
    */
    public function scopeJoinUser($query)
    {
        return $query->join('users', 'users.id', '=', 'contacts.contact_user_id')
                     ->select('users.name');
    }

    /**
    *
    */
    public function scopeWhereContact($query, $user)
    {
        return $query->where('contacts.user_id', $user);
    }
}