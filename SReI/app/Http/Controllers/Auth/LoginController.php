<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use GuzzleHttp\Client;

use \App\User;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function index() {
        return view('auth.login');
    }

    public function searchUser() {
        $client = new Client([
            'base_uri' => 'http://localhost:3000/API/usuario/',
            'timeout' => 2.0
        ]);

        $response = $client->request('GET', 'login',
            [
                'json' => [
                    'username' => "201800217",
                    'password' => "1234",
                ]
            ]);

        $data = json_decode($response->getBody()->getContents());
        $object_data = $data->usuario[0];

        $user = new User([
            '_id' => $object_data->_id,
            'tipo' => $object_data->tipo,
            'usuario' => $object_data->usuario,
            'clave' => $object_data->clave,
            'nombre' => $object_data->nombre,
            'apellidoPaterno' => $object_data->apellidoPaterno,
            'apellidoMaterno' => $object_data->apellidoMaterno,
            'activo' => $object_data->activo,
            'permisos' => $object_data->permisos
        ]);

        Auth::login($user);

        //return view('pruebas', ['user' => $user,'object' => $object_data]);

    }
}
