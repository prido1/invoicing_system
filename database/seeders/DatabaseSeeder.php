<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\UserController::factory(10)->create();
        $this->call(EmailTemplate::class);
        $this->call(PaymentStatus::class);
        $this->call(PaymentType::class);
        $this->call(PaymentCurrency::class);
        $this->call(Role::class);
        $this->call(Permission::class);
        $this->call(Users::class);
    }
}
