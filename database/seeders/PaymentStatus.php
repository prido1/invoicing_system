<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=>'paid'),
            array('name'=>'unpaid'),
            array('name'=>'canceled'),
            array('name'=>'partially paid'),
            array('name'=>'pending'),
        );
        \App\Models\PaymentStatus::insert($data);
    }
}
