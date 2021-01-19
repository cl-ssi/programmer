<?php

namespace App;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\RequestException;

use Illuminate\Database\Eloquent\Model;

class WsHospital extends Model
{
  public static function ws_hospital_intervenciones()
  {
    $array = array(
        'usuario' => 'ssi_integracion',
        'clave' => '#ssi*integracion',
        'aplicacion' => 'ssi integracion'
    );

    $response = [];
    $client = new \GuzzleHttp\Client();
    try {
        $response = $client->request('POST', 'https://api.hospitaliquique.cl/ssi/login', [
            'json' => $array,
            'headers'  => ['content-type' => 'application/json']
        ]);

        //obtiene token
        $array = json_decode($response->getBody()->getContents(), true);

        //obtiene detalles
        try {
            $response = $client->request('GET', 'https://api.hospitaliquique.cl/ssi/pabellones/intervenciones', [
                'headers'  => ['Authorization' => $array['token']]
            ]);

            //obtiene token
            $array = json_decode($response->getBody()->getContents(), true);

            $response = ['status' => 1, 'msg' => $array];

          } catch (RequestException $e) {
              $response = $e->getResponse();
              if($response){
                  $responseBodyAsString = $response->getBody()->getContents();
                  $decode = json_decode($responseBodyAsString);
                  $response = ['status' => 0, 'msg' => $decode->error];
              }
              else{
                  $response = ['status' => 0, 'msg' => 'No se pudo conectar a plataforma de toma de muestras. Por favor intente nuevamente en un momento.'];
              }
          }catch (Exception $e){
              $response = ['status' => 0, 'msg' => "Error inesperado en conexión a plataforma de toma de muestras. Por favor intente nuevamente en un momento. {$e->getMessage()}"];
          }

          return $response;



      } catch (RequestException $e) {
          $response = $e->getResponse();
          if($response){
              $responseBodyAsString = $response->getBody()->getContents();
              $decode = json_decode($responseBodyAsString);
              $response = ['status' => 0, 'msg' => $decode->error];
          }
          else{
              $response = ['status' => 0, 'msg' => 'No se pudo conectar a plataforma de toma de muestras. Por favor intente nuevamente en un momento.'];
          }
      }catch (Exception $e){
          $response = ['status' => 0, 'msg' => "Error inesperado en conexión a plataforma de toma de muestras. Por favor intente nuevamente en un momento. {$e->getMessage()}"];
      }

      return $response;
  }
  
}
