<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Permission::create([
            'role_id' => 1,
            'permission' => array(
                'role' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'permission' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'activityLog' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'user' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'client' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'invoice' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'quotation' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'expense' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'setting' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1),
                'email_template' => array('create' => 1, 'update' => 1, 'read' => 1, 'delete' => 1, 'list' => 1))
        ]);
    }
}
