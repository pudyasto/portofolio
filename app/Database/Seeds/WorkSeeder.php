<?php

namespace App\Database\Seeds;

class WorkSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = array(
            [
                'company' => 'Joko Tech',
                'position'    => 'Web Developer',
                'date_start'    => '2015-01-31',
                'date_finish'    => '2018-01-31',
                'description'    => 'Create web application using php - codeiginter 4 and database mysql',
            ],
            [
                'company' => 'Joko Hospital',
                'position'    => 'Android Developer',
                'date_start'    => '2018-02-01',
                'date_finish'    => null,
                'description'    => 'Create android application using flutter and API',
            ],
        );

        // Using Query Builder
        $this->db->table('work')->insertBatch($data);
    }
}
