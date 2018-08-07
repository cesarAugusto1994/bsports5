<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $createUsersPermission = Permission::create([
          'name' => 'Acessar Painel do Jogador',
          'slug' => 'player-panel',
        ]);

        $createUsersPermission = Permission::create([
          'name' => 'Acessar Painel do Administrador',
          'slug' => 'admin-panel',
        ]);
    }
}
