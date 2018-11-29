<?php

namespace App\Helpers;

use App\Models\{Categoria, Quadras, Config, Torneio};
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
}
