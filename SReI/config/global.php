<?php
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Firestore;

use GuzzleHttp\Client;

$factory = (new Factory)->withServiceAccount(__DIR__.'/key_document.json');
$firestore = $factory->createFirestore();
$db = $firestore->database();

$api = new Client([
    'base_uri' => 'http://localhost:3001/API_SREI/',
    'timeout' => 200,
]);


return [
    'upiiz' => '09h0FOHyr6xF2MAzGoyP',
    'data' => [
        'propietario' => '09h0FOHyr6xF2MAzGoyP',
        'estado' => 2,
        'disponible' => true
    ],
    // Conecciones
    'firestore' => $db,
    'api' => $api,

];
