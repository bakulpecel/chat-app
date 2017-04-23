<?php

namespace App\Controllers;

use App\Models\MessageModel;
use App\Models\ContactModel;
use App\Models\AuthModel;
use App\Models\UserModel;

/**
* 
*/
class MessageController extends Controller
{
    /**
    * 
    */
    public function postSend($request, $response)
    {
        $auth = AuthModel::where('key', $request->getHeaders()['HTTP_AUTHORIZATION'][0])
                ->first();
        $user = UserModel::where('id', $request->getParam('to'))
                ->first();

        if (!is_null($user)) {
            MessageModel::create([
                'sender_id'   => $auth->user_id,
                'receiver_id' => $request->getParam('to'),
                'message'     => $request->getParam('message'),
            ]);

            $data['status']  = 200;
            $data['message'] = 'Message successfully sent';
        } else {
            $data['status']  = 404;
            $data['message'] = 'Message destination is not available';
        }

        return parent::returnJson($response, $data, $data['status']);
    }

    /**
    * 
    */
    public function getConversation($request, $response, $args)
    {
        $auth         = AuthModel::where('key', $request->getHeader('HTTP_AUTHORIZATION')[0])
                        ->first();
        $message      = new MessageModel();
        $conversation = $message->joinUser()
                        ->whereConversation($args['id'], $auth->user_id)
                        ->orderBy('created_at', 'ASC')
                        ->get();

        if (!is_null($conversation->first())) {
            $data['status']       = 200;
            $data['conversation'] = $conversation;
        } else {
            $data['status']  = 404;
            $data['message'] = 'No conversation';
        }

        return parent::returnJson($response, $data, $data['status']);
    }
}