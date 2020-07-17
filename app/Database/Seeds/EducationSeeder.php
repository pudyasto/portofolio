<?php

namespace App\Database\Seeds;

class EducationSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = array(
            [
                'institute' => 'Stekom University',
                'graduate'    => 'Bachelor of Computer Science',
                'date_start'    => '2008-06-01',
                'date_finish'    => '2013-06-31',
                'description'    => 'Create web application using php - codeiginter 4 and database mysql',
            ],
        );

        // Using Query Builder
        $this->db->table('education')->insertBatch($data);
    }
}
