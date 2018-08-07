<?php

use Illuminate\Database\Seeder;
use App\Models\StatusVenda;

class StatusVendaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          'Aguardando pagamento',
          'Em Análise',
          'Paga',
          'Disponível',
          'Em Disputa',
          'Devolvida',
          'Cancelada',
          'Chargeback denitado',
          'Em Contestação',
        ];

        foreach ($itens as $key => $item) {
            $status = new StatusVenda();
            $status->nome = $item;
            $status->save();
        }
    }
}
