<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PaymentCurrency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array('name'=>'USD'),
            array('name'=>'ZWL'),
            array('name'=>'RTGS'),
        );
        \App\Models\PaymentCurrency::insert($data);
    }
}
