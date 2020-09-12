<?php
use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Firestore;

$factory = (new Factory)->withServiceAccount(__DIR__.'/key_document.json');
$firestore = $factory->createFirestore();
$db = $firestore->database();


return [
    'firestore' => $db,
];
