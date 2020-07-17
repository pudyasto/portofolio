<?php

namespace App\Database\Seeds;

class DataSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->call('ProfileSeeder');
        $this->call('ProductSeeder');
        $this->call('SkillSeeder');
        $this->call('WorkSeeder');
        $this->call('EducationSeeder');
        $this->call('UserSeeder');
    }
}
