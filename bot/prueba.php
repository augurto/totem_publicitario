<?php
// Conexión a la base de datos
$servername = "127.0.0.1:3306";
$username = "u291982824_bot";
$password = "Bot*#6969";
$dbname = "u291982824_bot";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Consulta SQL
$id_producto = 91076;

$sql = "SELECT * from productos where idProducto=2";

$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
// Obtener el resultado en un array asociativo
$row = mysqli_fetch_assoc($resultado);
$nombre_producto = $row["nombreProducto"];
$precio_producto1 = $row["precioProducto"];
$precio_producto2 = $row["URL"];
  $marca = $row["nombreProducto"];
} else {
$nombre_producto = "No se encontró el producto";
$precio_producto = "";
}

mysqli_close($conn);

// Imprimir el nombre del producto


// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



// to allow only authorized requests, you need to configure your .htaccess file and set the credentials with the Basic Auth option in AutoResponder

// access a custom header added in your AutoResponder rule
// replace XXXXXX_XXXX with the name of the header in UPPERCASE (and with '-' replaced by '_')
$myheader = $_SERVER['HTTP_XXXXXX_XXXX'];
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure json data is not incomplete
if(
	!empty($data->query) &&
	!empty($data->appPackageName) &&
	!empty($data->messengerPackageName) &&
	!empty($data->query->sender) &&
	!empty($data->query->message)
){
	
	// package name of AutoResponder to detect which AutoResponder the message comes from
	$appPackageName = $data->appPackageName;
	// package name of messenger to detect which messenger the message comes from
	$messengerPackageName = $data->messengerPackageName;
	// name/number of the message sender (like shown in the Android notification)
	$sender = $data->query->sender;
	// text of the incoming message
	$message = $data->query->message;
	// is the sender a group? true or false
	$isGroup = $data->query->isGroup;
	// name/number of the group participant who sent the message if it was sent in a group, otherwise empty
	$groupParticipant = $data->query->groupParticipant;
	// id of the AutoResponder rule which has sent the web server request
	$ruleId = $data->query->ruleId;
	// is this a test message from AutoResponder? true or false
	$isTestMessage = $data->query->isTestMessage;
	
	
	
	// process messages here
	
	
	
	// set response code - 200 success
	http_response_code(200);

	// send one or multiple replies to AutoResponder
	echo json_encode(array(
      "replies" => array(
        
        array("message" => "Mensaje " . $sender . "\nProducto: " . $nombre_producto."\nPrecio por Mayor: S/".$precio_producto1."\nPrecio por menor: S/".$precio_producto2."\nMarca: ".$marca),
       
        
        
      )
    ));
	
	// or this instead for no reply:
	// echo json_encode(array("replies" => array()));
}


// tell the user json data is incomplete
else{
	
	// set response code - 400 bad request
	http_response_code(400);
	
	// send error
	echo json_encode(array("replies" => array(
		array("message" => "Error ❌"),
		array("message" => "JSON data is incomplete. Was the request sent by AutoResponder?")
	)));
}
?>