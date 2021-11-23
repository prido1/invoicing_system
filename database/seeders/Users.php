<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'info@chiminyalogistics.co.zw',
            'status' => true,
            'role_id' => 1,
            'password' => bcrypt('chiminya@2021')
        ]);
    }
}
