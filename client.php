<?php
  if(isset($_REQUEST['fruts']))
  {
    $frutas = array("manzana"=>"verde","uva"=>"morada");
    echo json_encode($frutas);
  }

  if(isset($_REQUEST['client']))
  {
    $client = array("nombre"=>"Milan Paucar","edad"=>"32");
    echo json_encode($client);
  }

/*
http://localhost/webservice/client.php
{
    "nombre":"Victor",
    "apellido":"Paucar"
}
*/
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents('php://input'));
  if($data != NULL && isset($data->nombre) && isset($data->apellido)) 
  {
    if($data->nombre!='' && $data->apellido!='')
    {
      class Response{
        public $code = "";
        public $message = "";
        public $data = null;
      }
      class User{
        public $name = "";
        public $firstName = "";
      }

      $user = new User;
      $user->name = $data->nombre;
      $user->firstName = $data->apellido;

      $response = new Response;
      $response->code = "000";
      $response->message = "Respuesta exitosa";
      $response->data = $user;
      echo json_encode($response);
    }
    else
    {
      class Response{
        public $code = "";
        public $message = "";
        public $data = null;
      }
      $response = new Response;
      $response->code = "480";
      $response->message = "Los campos son obligatorios";
      echo json_encode($response);
    }
  }
  else
  {
    class Response{
      public $code = "";
      public $message = "";
      public $data = null;
    }
    $response = new Response;
    $response->code = "470";
    $response->message = "Valores incompletos de entrada";
    echo json_encode($response);
  }
}
?>