<?php

namespace App\Database\Seeds;

class SkillSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = array(
            [
                'name'    => 'PHP Codeigniter',
                'description'    => 'Codeigniter is very easy to use and implemented quickly. Lightweight and secure, everyone can easily understand it.',
                'percent'    => '85',
            ],
            [
                'name'    => 'Jquery',
                'description'    => 'jQuery is a cross-platform JavaScript library designed to simplify the client-side scripting of HTML. It is free, open-source software using the permissive MIT License.',
                'percent'    => '76',
            ],
            [
                'name'    => 'MySQL',
                'description'    => 'MySQL is an open-source relational database management system (RDBMS).Its name is a combination of "My", the name of co-founder Michael Widenius\'s daughter,and "SQL", the abbreviation for Structured Query Language.',
                'percent'    => '80',
            ],
            [
                'name'    => 'HTML',
                'description'    => 'HTML5 is a markup language used for structuring and presenting content on the World Wide Web. It is the fifth and current major version of the HTML standard.',
                'percent'    => '80',
            ],
        );

        // Using Query Builder
        $this->db->table('skill')->insertBatch($data);
    }
}
