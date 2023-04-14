<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // 'role-list',
            // 'role-create',
            // 'role-edit',
            // 'role-delete',
            // 'aluno-list',
            // 'aluno-create',
            // 'aluno-edit',
            // 'aluno-delete'
            'frequency-list',
            'frequency-create',
            'frequency-edit',
            'frequency-delete',
            'frequency-read',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
         ];
       
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
