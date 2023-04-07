<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateObserverUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Firebase User',
            'email' => 'firebaseuser@cnit.com',
            'password' => bcrypt('159753456cnit2023')
        ]);

        $role = Role::create(['name' => 'Observer']);

        $role->givePermissionTo('aluno-list');

        $user->assignRole([$role->id]);
    }
}
