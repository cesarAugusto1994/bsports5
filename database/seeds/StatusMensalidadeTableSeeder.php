<?php

use Illuminate\Database\Seeder;
use App\Models\Mensalidade\Status;

class StatusMensalidadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = ['Em Aberto','Pago', 'Informe de Pagamento'];

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
          'Informe de Pagamento'
        ];

        foreach ($itens as $key => $item) {
          Status::create(['nome' => $item, 'label' => str_slug($item)]);
        }
    }
}
