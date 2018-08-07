<?php

use Illuminate\Database\Seeder;
use App\Models\Venda\Gateway;

class GatewayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gateway = new Gateway();
        $gateway->nome = 'Pag Seguro';
        $gateway->save();
    }
}
