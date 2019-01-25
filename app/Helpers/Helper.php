<?php

namespace App\Helpers;

use App\Models\{Categoria, Quadras, Config, Torneio, Midia, Campeoes, Semestre};
use App\Models\Pessoa\Jogador;
use Session;
use Auth;

class Helper
{
    public static function getConfig($slug)
    {
        if(self::has($slug)) {
            $config = self::get($slug);
        }

        $hasConfig = Config::where('slug', $slug)->get();

        if($hasConfig->isEmpty()) {
            return null;
        }

        $config = $hasConfig->first();

        self::set($slug, $config->valor);
        return self::get($slug);
    }

    public static function slug($key)
    {
        return $key;
    }

    public static function has($key)
    {
        $slug = self::slug($key);
        return Session::exists($slug);
    }

    public static function get($key)
    {
        $slug = self::slug($key);
        return Session::get($slug);
    }

    public static function set($key, $value)
    {
        $slug = self::slug($key);
        return Session::put($slug, $value);
    }

    public static function drop($key)
    {
        $slug = self::slug($key);
        return Session::forget($slug);
    }

    public static function categorias()
    {
        $key = 'categorias';

        if(self::has($key)) {
            return self::get($key);
        }

        $categorias = Categoria::where('ativo', true)->orderBy('nome')->get();

        self::set($key, $categorias);
        return self::get($key);
    }

    public static function quadras()
    {
        $key = 'quadras';

        if(self::has($key)) {
            return self::get($key);
        }

        $quadras = Quadras::where('ativo', true)->get();

        self::set($key, $quadras);
        return self::get($key);
    }

    public static function torneios()
    {
        $key = 'torneios';

        if(self::has($key)) {
            return self::get($key);
        }

        $torneios = Torneio::where('ativo', true)->get();

        self::set($key, $torneios);
        return self::get($key);
    }

    public static function semestres()
    {
        $key = 'semestres';

        if(self::has($key)) {
            return self::get($key);
        }

        $vigencia = now();

        $semestre = Semestre::all();

        self::set($key, $semestre);
        return self::get($key);
    }

    public static function imagens()
    {
        $key = 'imagens';

        if(self::has($key)) {
            return self::get($key);
        }

        $midias = Midia::where('tipo', 'imagem')->where('ativo', true)->get();

        self::set($key, $midias);
        return self::get($key);
    }

    public static function videos()
    {
        $key = 'videos';

        if(self::has($key)) {
            return self::get($key);
        }

        $midias = Midia::where('tipo', 'video')->where('ativo', true)->get();

        self::set($key, $midias);
        return self::get($key);
    }

    public static function campeoes()
    {
        $key = 'campeoes';

        if(self::has($key)) {
            return self::get($key);
        }

        $campeoes = Campeoes::all();

        self::set($key, $campeoes);
        return self::get($key);
    }

    public static function classificacao()
    {
        $key = 'classificacao';

        if(self::has($key)) {
            return self::get($key);
        }

        $sql = "select
                jg.id,
                jg.uuid,
                jg.nome,
                categoria_id categoria,
                sum(partida.jogador1_pontos) - SUM(partida.jogador1_bonus) as pontos,
                '' link,
                '' url
                from partidas partida
                inner join jogadores jg ON(jg.id = partida.jogador1_id)
                where jg.categoria_id = ?
                group by jg.id, jg.uuid, jg.nome, jg.categoria_id
                order by pontos DESC
                limit 5";

        $resultado = \DB::select($sql, [$id]);

        $ranking = [];

        foreach ($resultado as $key => $item) {

          $nomeArray = explode(" ", $item->nome);

          $primeiroNome = $nomeArray[0] ?? "";
          $ultimoNome = $nomeArray[1] ?? "";

          $ranking[] = [
            "id" => $item->id,
            "uuid" => $item->uuid,
            "primeiro_nome" => $primeiroNome,
            "ultimo_nome" => $ultimoNome,
            "categoria" => $item->categoria,
            "pontos" => $item->pontos,
            "link" => $item->link,
            "url" => $item->url
          ];
        }

        self::set($key, $ranking);
        return self::get($key);
    }

    public static function jogadorPosicao($jogadorId)
    {
        $jogador = Jogador::findOrFail($jogadorId);

        $categoria = $jogador->categoria;

        $jg = [];

        $index = 1;

        $jogadores = Jogador::where('categoria_id', $categoria->id)->get();

        foreach ($jogadores as $key => $jogador) {

            $jg[] = [
              'id' => $jogador->id,
              'posicao' => $index,
              'pontos' => $jogador->partidas->sum('pontos')
            ];

            $index++;

        }

        usort($jg, function ($item1, $item2) {
            return $item1['pontos'] <=> $item2['pontos'];
        });

        $player = array_filter($jg, function($item) use ($jogadorId) {
            return $item['id'] == $jogadorId;
        });

        return current($player);
    }

    public static function pontosPorPosicao($posicao)
    {
        $bonus = 0;

        if($posicao >= 1 && $posicao <= 5) {

            $bonus = 9;

        } elseif($posicao >= 6 && $posicao <= 10) {

            $bonus = 7;

        } elseif($posicao >= 11 && $posicao <= 15) {

            $bonus = 5;

        } elseif($posicao >= 16 && $posicao <= 30) {

            $bonus = 3;

        }

        return $bonus;
    }

    public static function categoriasHierarquia($categoriaJogador)
    {
        $categorias = [
          [
            'id' => 1,
            'nivel' => 5,
          ],
          [
            'id' => 2,
            'nivel' => 3,
          ],
          [
            'id' => 3,
            'nivel' => 1,
          ],
          [
            'id' => 4,
            'nivel' => 5,
          ],
          [
            'id' => 5,
            'nivel' => 3,
          ],
          [
            'id' => 6,
            'nivel' => 1,
          ],
          [
            'id' => 7,
            'nivel' => 10,
          ],
          [
            'id' => 8,
            'nivel' => 9,
          ],
          [
            'id' => 9,
            'nivel' => 2,
          ],
        ];

        $categoria = array_filter($categorias, function($categoria) use($categoriaJogador) {
            return $categoria['id'] == $categoriaJogador;
        });

        return !empty($categoria) ? current($categoria)['nivel'] : null;
    }
}
