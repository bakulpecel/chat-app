<?php

namespace App\Auth;

use App\Models\UserModel;
use App\Models\AuthModel;

/**
* 
*/
class Auth
{
    /**
    * 
    */
    public function attempt($username, $password)
    {
        $user = UserModel::where('username', $username)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            if (is_null(AuthModel::where('key', md5($username))->first())) {
                AuthModel::create([
                    'user_id' => $user->id,
                    'key'     => md5($username),
                    'expired' => date('Y-m-d', strtotime('+6 days')),
                ]);
            }

            return true;
        }

        return false;
    }

    /**
    * 
    */
    public function check($key)
    {
        $auth = AuthModel::where('key', $key)->first();

        if (!is_null($auth)) {
            if (date('Y-m-d H:i:s') < $auth->expired) {
                return true;
            } else {
                $auth->delete();
            }
        }

        return false;
    }

    /**
    * 
    */
    public function logout($key)
    {
        $auth = AuthModel::where('key', $key)->first();

        return $auth->delete();
    }
}