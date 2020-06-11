<?php 

    $archivo = fopen("notifications/".date("Y-m-d__his").".json","w+");
    fwrite($archivo,json_encode($_POST));

echo "notificacion recibida";

 ?>