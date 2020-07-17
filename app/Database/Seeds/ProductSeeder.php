<?php

namespace App\Database\Seeds;

class ProductSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = array(
            [
                'category' => 'Open Source',
                'name'    => 'Portofolio',
                'description'    => 'This is my first web application using codeigniter 4',
                'image'    => 'demo-1.jpg',
            ],
            [
                'category' => 'Commercial',
                'name'    => 'Point of Sales',
                'description'    => 'Point of Sales Web Apps build with codeigniter 4',
                'image'    => 'demo-2.jpg',
            ],
            [
                'category' => 'Team Work',
                'name'    => 'ERM Web Apps',
                'description'    => 'ERM Web Apps build with codeigniter 4',
                'image'    => 'demo-3.jpg',
            ]
        );

        // Using Query Builder
        $this->db->table('product')->insertBatch($data);
    }
}
