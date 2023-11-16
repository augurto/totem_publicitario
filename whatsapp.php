<?php
$token = 'EAAkOIS6U3UIBO9Sz1rAdOhNpYo5ZBC4gCN4wZAtcwpQKjZCJ4u7vN92oEOmDDM0seHZBC4k8MvaBNKMkG4qwUpto4kVjY5i0sZB035BO2u22n49Q8hZAYVSSEbZCUrDDNVVGfsa83yyqbJaSpo13WZBV2AvzQcaMa2ggQJHgKznZCUEO7oPCu90rtLIZCunIuh644nDtdgnu421whfc6fwGiRJlhZBRYIxraPRoFtzUtw0ZBhVcTJE4Xz4uK';
$telefono = '51980683461';
$url = 'https://graph.facebook.com/v15.0/166625639867609/messages';
$mensaje = ''
    . '{'
    . '"messaging_product": "whatsapp", '
    . '"to": "' . $telefono . '", '
    . '"type": "template", '
    . '"template": '
    . '{'
    . '     "name": "hello_world",'
    . '     "language":{ "code": "en_US" } '
    . '} '
    . '}';
$header = array("Authorization: Bearer " . $token, "Content-Type: application/json", );
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = json_decode(curl_exec($curl), true);
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
print_r($response);
print_r($status_code);
?>