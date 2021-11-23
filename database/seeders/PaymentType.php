<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name' => 'Cash'),
            array('name' => 'Bank Transfer'),
            array('name' => 'Ecocash'),
        );
        \App\Models\PaymentType::insert($data);
    }
}
