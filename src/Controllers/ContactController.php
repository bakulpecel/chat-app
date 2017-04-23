<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\AuthModel;

/**
* 
*/
class ContactController extends Controller
{
    /**
    * 
    */
    public function postAdd($request, $response)
    {
        $auth = AuthModel::where('key', $request->getHeader('HTTP_AUTHORIZATION')[0])
                ->first();

        if (is_null(ContactModel::where('user_id', $auth->user_id)->where('contact_user_id', $request->getParam('contact'))->first())) {
            ContactModel::create([
                'user_id'           => $auth->user_id,
                'contact_user_id'   => $request->getParam('contact')
            ]);

            $data['status']     = 200;
            $data['message']    = 'Contact successfully added';
        } else {
            $data['status']     = 200;
            $data['message']    = 'Contact already exists';
        }

        return parent::returnJson($response, $data, $data['status']);
    }

    /**
    * 
    */
    public function getList($request, $response)
    {
        $auth    = AuthModel::where('key', $request->getHeader('HTTP_AUTHORIZATION')[0])
                   ->first();
        $contact = new ContactModel;
        $contact = $contact->joinUser()
                   ->whereContact($auth->user_id)
                   ->get();
                
        if (!is_null(ContactModel::where('user_id', $auth->user_id)->first())) {
            $data['status']  = 200;
            $data['contact'] = $contact;
        } else {
            $data['status']  = 404;
            $data['message'] = 'You dont have contact';
        }

        return parent::returnJson($response, $data, $data['status']);
    }

    /**
    * 
    */
    public function delete($request, $response, $args)
    {
        $auth    = AuthModel::where('key', $request->getHeaders()['HTTP_AUTHORIZATION'][0])
                   ->first();
        $contact = ContactModel::where('user_id', $auth->user_id)
                   ->where('contact_user_id', $args['id'])
                   ->first();

        if (!is_null($contact)) {
            $contact->delete();

            $data['status']  = 200;
            $data['message'] = 'Contact has been successfully deleted';
        } else {
            $data['status']  = 404;
            $data['message'] = 'Contact not available';
        }

        return parent::returnJson($response, $data, $data['status']);
    }
}