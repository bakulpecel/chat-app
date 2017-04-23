<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
*
*/
class MessageModel extends Model
{
    protected $table        = 'messages';
    protected $primaryKey   = 'id';
    protected $fillable     = ['sender_id', 'receiver_id', 'message'];
    public $timestamps      = true;

    /**
    *
    */
    public function scopeJoinUser($query)
    {
       return $query->join('users as sender', 'sender.id', '=', 'messages.sender_id')
                    ->join('users as receiver', 'receiver.id', '=', 'messages.receiver_id')
                    ->select('sender.name as sender', 'receiver.name as receiver', 'messages.message', 'messages.created_at');
    }

    public function scopeWhereConversation($query, $auth, $to)
    {
        return $query->where([
            ['messages.sender_id', $auth],
            ['messages.receiver_id', $to]
        ])->orWhere([
            ['messages.sender_id', $to],
            ['messages.receiver_id', $auth]
        ]);
    }
}