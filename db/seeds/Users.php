<?php

use Phinx\Seed\AbstractSeed;

class Users extends AbstractSeed
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
                'name'      => 'ilham',
                'username'  => 'ilham',
                'email'     => 'ilham@gmail.com',
                'password'  => password_hash('ilham123', PASSWORD_DEFAULT)
            ],
            [
                'name'      => 'desfar',
                'username'  => 'desfar',
                'email'     => 'desfar@gmail.com',
                'password'  => password_hash('desfar123', PASSWORD_DEFAULT)
            ],
            [
                'name'      => 'gatot',
                'username'  => 'gatot',
                'email'     => 'gatot@gmail.com',
                'password'  => password_hash('gatot123', PASSWORD_DEFAULT)
            ],
        ];

        $posts = $this->table('users');
        $posts->insert($data)->save();
    }
}
