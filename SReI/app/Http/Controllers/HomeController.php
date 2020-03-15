<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function prueba(Request $request) {
        $enviar = \GuzzleHttp\RequestOptions::JSON;

        $client = new Client([
            'base_uri' => 'http://localhost:3000/',
            'timeout' => 2.0
        ]);

        $data = [
            'username' => $request->rfc,
            'password' => $request->pass
        ];

        $response = $client->request('POST', '/login',[ $enviar => $data ]);
        echo "hola";
        /*$data = json_decode($response->getBody()->getContent());

        dd($data);
        die();*/
    }
}
