<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\{Pessoa, Partida, Semana, Categoria, Pagina};
use App\Models\Pessoa\{Jogador, Telefone};

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        \DB::table('role_user')->insert([
          'user_id' => $user->id,
          'role_id' => 3
        ]);

        $pessoa = new Pessoa();
        $pessoa->nome = $data['name'];
        $pessoa->nascimento = now();
        $pessoa->email = $data['email'];
        $pessoa->save();

        $jogador = new Jogador();
        $jogador->lateralidade = 'Destro';
        $jogador->categoria_simples_id = 1;
        $jogador->pessoa_id = $pessoa->id;
        $jogador->save();

        return $user;
    }
}
