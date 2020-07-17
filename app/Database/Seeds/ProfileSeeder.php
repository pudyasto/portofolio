<?php

namespace App\Database\Seeds;

class ProfileSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'full_name' => 'Mas Joko',
            'birth_date'    => '1988-10-12',
            'birth_place'    => 'Semarang',
            'phone'    => '6281-226-250-150',
            'email'    => 'mr.joko@gmail.com',
            'address'    => 'Wologito Barat',
            'city'    => 'Kota Semarang',
            'linkedin'    => 'https://www.linkedin.com/in/mas.joko/',
            'instagram'    => 'https://www.instagram.com/mas.joko/',
            'facebook'    => 'https://www.facebook.com/mas.joko/',
            'twitter'    => 'https://www.twitter.com/@mas.joko/',
            'quotes'    => 'Stop Learning Start Dying',
            'about_me'    => 'I like to receive and deal with challenging tasks. I am a very enthusiastic student and I think this is a strong point of mine. My friends say that I am a very funny and an interesting girl with a good sense of humor.',
        ];

        // Using Query Builder
        $this->db->table('profile')->insert($data);
    }
}
