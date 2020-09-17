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
    'firestore' => $db,
    'api' => $api,
];
