<?php

namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'email' => 'admin@demo.com',
            'username'    => 'admin',
            'password_hash'    => '$2y$10$W3WmUZopXs.JnDUQansCKui56THjS0aSPicAVNnOF78b1vvN4mOaW',
            'active'    => '1',
            'force_pass_reset'    => '0',
            'created_at' => '2020-07-16 07:07:13',
            'updated_at' => '2020-07-16 07:07:13',
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
