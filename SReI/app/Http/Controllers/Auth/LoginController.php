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

    public function searchUser(Request $request) {
        $client = new Client([
            'base_uri' => 'http://localhost:3000/API/usuario/',
            'timeout' => 2.0
        ]);

        $response = $client->request('GET', 'login',
            [
                'json' => [
                    'username' => $request->username,
                    'password' => $reuqets->pass
                ]
            ]);

        $data = json_decode($response->getBody()->getContents());
        $object_data = $data->usuario[0];

        if($data->estatus) {
            if(empty($object_data)) {
                return back()->withErrors('Usuario no encontrado');
            }

            self::login($data);
        } else {
            return back()->withErrors('No se encontro el rfc registrado en la escuela');
        }
    }

    public static function login($data) {
        $user = new User([
            '_id' => $data->_id,
            'tipo' => $data->tipo,
            'usuario' => $data->usuario,
            'clave' => $data->clave,
            'nombre' => $data->nombre,
            'edificio' => $data->edificio
        ]);

        Auth::login($user);

        return view('pruebas', ['user' => $user,'object' => $data]);
    }
}
