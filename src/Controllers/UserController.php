<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\AuthModel;

/**
* 
*/
class UserController extends Controller
{
    /**
    * 
    */
    public function postSignIn($request, $response)
    {
        $rules = [
            'required' => [
                ['username'], ['password']
            ],
            'lengthMin' => [
                ['username', 5], ['password', 6]
            ]
        ];

        $this->validator->rules($rules);

        if ($this->validator->validate()) {
            $auth = $this->auth->attempt(
                $request->getParam('username'),
                $request->getParam('password')
            );

            if (!$auth) {
                $data['status']  = 401;
                $data['message'] = 'Wrong username or password!';
            } else {
                $user = UserModel::where('username', $request->getParam('username'))
                        ->first();

                $data['token']   = AuthModel::where('user_id', $user->id)->first()->key;
                $data['status']  = 200;
                $data['message'] = 'Login successfull';
            }   
        } else {
            $data['status']   = 400;
            $data['messages'] = $this->validator->errors();
        }

        return parent::returnJson($response, $data, $data['status']);
    }

    /**
    * 
    */
    public function postSignUp($request, $response)
    {
        $rules = [
            'required' => [
                ['name'], ['username'], ['email'], ['password']
            ],
            'email' => [
                ['email']
            ],
            'lengthMin' => [
                ['name', 5], ['username', 5], ['email', 10], ['password', 6]
            ],
            'lengthMax' => [
                ['name', 20], ['username', 12], ['password', 32]
            ],
        ];

        $this->validator->rules($rules);

        if ($this->validator->validate()) {
            if (!UserModel::where('username', $request->getParam('username'))->first()) {
                UserModel::create([
                    'name'      => strtolower($request->getParam('name')),
                    'username'  => strtolower($request->getParam('username')),
                    'email'     => strtolower($request->getParam('email')),
                    'password'  => password_hash($request->getParam('password'), PASSWORD_DEFAULT)
                ]);

                $data['status']  = 201;
                $data['message'] = 'Registration successfull';
            } else {
                $data['status']  = 400;
                $data['message'] = 'Username has been used';
            }   
        } else {
            $data['status']   = 400;
            $data['messages'] = $this->validator->errors();
        }

        return parent::returnJson($response, $data, $data['status']);
    }

    /**
    * 
    */
    public function postSignOut($request, $response)
    {
        $this->auth->logout($request->getHeader('HTTP_AUTHORIZATION')[0]);

        $data['status']   = 200;
        $data['messages'] = 'You have successfully logout';

        return parent::returnJson($response, $data, $data['status']);
    }
}