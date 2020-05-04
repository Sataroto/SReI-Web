<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use GuzzleHttp\Client;

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

        $response = $client->request('POST', 'login',
            [
                'json' => [
                    'username' => "2222222222",
                    'password' => "1234",
                ]
            ]);
        $data = json_decode($response->getBody()->getContents());

        //dd($data->datos->token);
        if($data->estatus == "true") {
            //dd(Auth::attempt(['token' => $data->datos->token]));
            dd($data->datos->token);
        }

        die();

    }
}
