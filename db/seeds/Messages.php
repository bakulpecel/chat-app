<?php

use Phinx\Seed\AbstractSeed;

class Messages extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'sender_id'     => 1,
                'receiver_id'   => 2,
                'Message'       => 'Ini ilham untuk mas desfar'
            ],
            [
                'sender_id'     => 1,
                'receiver_id'   => 3,
                'Message'       => 'Ini ilham untuk mas gatot'
            ],
            [
                'sender_id'     => 2,
                'receiver_id'   => 3,
                'Message'       => 'Ini desfar untuk mas gatot'
            ],
            [
                'sender_id'     => 2,
                'receiver_id'   => 1,
                'Message'       => 'Ini desfar untuk mas ilham'
            ],
            [
                'sender_id'     => 3,
                'receiver_id'   => 1,
                'Message'       => 'Ini gatot untuk mas ilham'
            ],
            [
                'sender_id'     => 3,
                'receiver_id'   => 2,
                'Message'       => 'Ini gatot untuk mas desfar'
            ],
        ];

        $posts = $this->table('messages');
        $posts->insert($data)->save();
    }
}
