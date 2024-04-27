<?php
/*
http://localhost/webservice/users.php
{
    "user":"PEREZ",
    "password":"22988523"
}
*/
require_once('Model/User.php');
require_once('Model/Responses.php');
include("conection.php");
$con=conectarse();

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  $data = json_decode(file_get_contents('php://input'));
  if($data != NULL && isset($data->user) && isset($data->password)) 
  {
    if($data->user!='' && $data->password!='')
    {
        $query = "SELECT US_ID_BI,US_NAME_VC,US_USER_VC,US_PASSWORD_VC,US_DATE_CREATION_DT,US_ROL_BT,US_STATUS_BT FROM USER where US_USER_VC='$data->user' and US_PASSWORD_VC='$data->password'";
	    $result = mysqli_query($con,$query);
	    if(!$result){die("query Failed"); }
	    $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if($count==1)
        {
            $user = new User;
            $user->id_user = $row['US_USER_VC'];
            $user->name = $row['US_NAME_VC'];
            $user->user = $row['US_USER_VC'];
            $user->password = $row['US_PASSWORD_VC'];
            $user->date_creation = $row['US_DATE_CREATION_DT'];
            $user->rol = $row['US_ROL_BT'];
            $user->status = $row['US_STATUS_BT'];
        }
        else
        {
            $user = new User;
        }
      $response = new Response;
      $response->code = "000";
      $response->message = "Respuesta exitosa";
      $response->data = $user;
      echo json_encode($response);
    }
    else
    {
      $response = new Response;
      $response->code = "480";
      $response->message = "Los campos son obligatorios";
      echo json_encode($response);
    }
  }
  else
  {
    $response = new Response;
    $response->code = "470";
    $response->message = "Valores incompletos de entrada";
    echo json_encode($response);
  }
}
?>