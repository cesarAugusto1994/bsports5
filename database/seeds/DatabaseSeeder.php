<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      Model::unguard();

      $this->call(RolesTableSeeder::class);
      $this->call(PermissionsTableSeeder::class);
      $this->call(StatusMensalidadeTableSeeder::class);
      $this->call(CategoriasTableSeeder::class);
      $this->call(QuadrasTableSeeder::class);
      $this->call(TorneiosTableSeeder::class);
      $this->call(PontuacoesTableSeeder::class);
      $this->call(ConfigsTableSeeder::class);
      $this->call(UsersTableSeeder::class);

      $this->call(GatewayTableSeeder::class);
      $this->call(StatusVendaPagSeguroTableSeeder::class);
      $this->call(StatusVendaTableSeeder::class);

      Model::reguard();

    }
}
