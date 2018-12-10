<?php

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itens = [
          'empresa-nome' => 'BSPORTS',
          'empresa-nome2' => 'B.Sports Tennis & Fitness ',
          'empresa-sobre' => '',

          'empresa-email' => 'bsports@bsports.com.br',
          'empresa-telefone' => '(11) 3871.9555',

          'empresa-endereco' => 'Rua Dona Ana Pimentel, 272 - Perdizes - São Paulo/SP',
          'empresa-horario-funcionamento' => 'Todos os dias',
          'empresa-facebook' => '',
          'empresa-twitter' => '',
          'empresa-google' => '',
          'empresa-vimeo' => '',
          'empresa-linkedin' => '',
          'empresa-youtube' => '',
          'empresa-banner-principal-texto' => 'Propaganda',
          'empresa-banner-principal-link' => '#',
          'empresa-banner-principal-imagem' => 'holder.js/275x500',
          'empresa-banner-topo-vertical' => 'holder.js/720x90',
          'categorias-home' => true,
          'pagina-regulamento' => '/',
        ];

        $itens = [
            [
                'nome' => 'Nome',
                'slug' => 'empresa-nome',
                'descricao' => 'Nome da Empresa',
                'valor' => 'BSPORTS'
            ],
            [
                'nome' => 'Nome Secundario',
                'slug' => 'empresa-nome-secundario',
                'descricao' => 'Nome Empresa Secundario',
                'valor' => 'B.Sports Tennis & Fitness'
            ],
            [
                'nome' => 'Informações',
                'slug' => 'empresa-informacoes',
                'descricao' => 'Informações da Empresa',
                'valor' => ''
            ],

            [
                'nome' => 'Email',
                'slug' => 'empresa-email',
                'descricao' => 'Email da Empresa',
                'valor' => 'bsports@bsports.com.br'
            ],
            [
                'nome' => 'Telefone',
                'slug' => 'empresa-telefone',
                'descricao' => 'Telefone da Empresa',
                'valor' => '(11) 3871.9555'
            ],
            [
                'nome' => 'Endereço',
                'slug' => 'empresa-endereco',
                'descricao' => 'Endereço da Empresa',
                'valor' => 'Rua Dona Ana Pimentel, 272 - Perdizes - São Paulo/SP'
            ],
            [
                'nome' => 'Horário Funcionamento',
                'slug' => 'empresa-horario-funcionamento',
                'descricao' => 'Horário de Funcionamento da Empresa',
                'valor' => 'Todos os dias'
            ],

            [
                'nome' => 'Facebook',
                'slug' => 'empresa-facebook',
                'descricao' => 'Facebook',
                'valor' => ''
            ],

            [
                'nome' => 'Twitter',
                'slug' => 'empresa-twitter',
                'descricao' => 'Twitter',
                'valor' => ''
            ],

            [
                'nome' => 'Google',
                'slug' => 'empresa-google',
                'descricao' => 'Google',
                'valor' => ''
            ],

            [
                'nome' => 'Vimeo',
                'slug' => 'empresa-vimeo',
                'descricao' => 'Vimeo',
                'valor' => ''
            ],

            [
                'nome' => 'Linkedin',
                'slug' => 'empresa-linkedin',
                'descricao' => 'Linkedin',
                'valor' => ''
            ],

            [
                'nome' => 'Youtube',
                'slug' => 'empresa-youtube',
                'descricao' => 'Youtube',
                'valor' => ''
            ],

            [
                'nome' => 'Visualizar Categorias',
                'slug' => 'categorias-home',
                'descricao' => 'Visualizar Categorias no menu',
                'valor' => '1'
            ],

            [
                'nome' => 'Página Regulamento',
                'slug' => 'pagina-regulamento',
                'descricao' => 'Página Regulamento',
                'valor' => '#'
            ],


            [
                'nome' => 'Notificação Nova Partida',
                'slug' => 'notificacao-nova-partida',
                'descricao' => 'Notificação Nova Partida',
                'valor' => '0'
            ],

            [
                'nome' => 'Notificação Nova Mensalidade',
                'slug' => 'notificacao-nova-mensalidade',
                'descricao' => 'Notificação Nova Mensalidade',
                'valor' => '0'
            ],

            [
                'nome' => 'Valor Mensalidade',
                'slug' => 'valor-mensalidade',
                'descricao' => 'Valor Mensalidade',
                'valor' => '256,00'
            ],

            [
                'nome' => 'Dias vencimento débito',
                'slug' => 'dias-vencimento-debito',
                'descricao' => 'Dias vencimento débito',
                'valor' => '5'
            ],
        ];

        foreach ($itens as $key => $item) {
            Config::create($item);
        }
    }
}
