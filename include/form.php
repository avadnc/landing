<?php

require 'vendor/autoload.php';
$url = 'http://DOMINIO DOLIBARR/api/index.php/thirdparties'; //Sustituir por la URL de Dolibarr
$api_key = 'APIKEY DOLIBARR'; // Sustituir por la APIKEY

$nombre = $_POST["nombre"];
$telefono = $_POST["telefono"];
$email = $_POST["email"];

$datos_array = [
    'name' => $nombre,
    'phone' => $telefono,
    'email' => $email,
    'client' => 2, //estado para ser cliente potencial
];

$client = new GuzzleHttp\Client();

try {
    $response = $client->request('POST', $url, [ //
        'headers' => ['Content-Type' => 'application/json'],
        'headers' => ['Accept' => 'application/json'],
        'headers' => ['DOLAPIKEY' => $api_key],
        'form_params' => $datos_array
    ]);

    header('Location: ../respuesta.html');

} catch (GuzzleHttp\Exception\BadResponseException $e) {

    $response = $e->getResponse();
    $responseBodyAsString = $response->getBody()->getContents();

    $respuesta = json_decode($responseBodyAsString, true);

}
