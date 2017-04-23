<?php

use Phinx\Seed\AbstractSeed;

class Contacts extends AbstractSeed
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
                'user_id' => 1,
                'contact_user_id' => 2
            ],
            [
                'user_id' => 1,
                'contact_user_id' => 3
            ],
            [
                'user_id' => 2,
                'contact_user_id' => 1
            ],
            [
                'user_id' => 2,
                'contact_user_id' => 3
            ],
            [
                'user_id' => 3,
                'contact_user_id' => 1
            ],
            [
                'user_id' => 3,
                'contact_user_id' => 1
            ],
        ];

        $posts = $this->table('contacts');
        $posts->insert($data)->save();
    }
}
