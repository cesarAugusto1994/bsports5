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
        $itens = ['Em Aberto','Pago'];

        foreach ($itens as $key => $item) {
          Status::create(['nome' => $item, 'label' => str_slug($item)]);
        }
    }
}
