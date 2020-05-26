<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

use App\Http\Controllers\Auth\LoginController;

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
    protected function validator(array $request)
    {
        return Validator::make($request, [
            'rfc' => ['required', 'string', 'max:12'],
            'password' => ['required', 'string', 'min:6', 'max:10', 'confirmed'],
            'tipo' => ['required'],
            'edificio' =>['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        $client = new Client([
            'base_uri' => 'http://localhost:3000/API/usuario/',
            'timeout' => 2.0
        ]);

        $response = $client->request('POST', 'register',
            [
                'json' => [
                    'username' => $request->rfc,
                    'password' => $request->password,
                    'tipo' => $request->tipo,
                    'edificio' => $request->edificio
                ]
            ]);

        $result = json_decode($response->getBody()->getContents());

        if($result->estatus) {
            LoginController::login($result->usuario);
        } else {
            return back()->withErrors('no se encontro el rfc registrado en la escuela');
        }

    }
}
