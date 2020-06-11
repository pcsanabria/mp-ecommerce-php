<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

$payer=new MercadoPago\Payer();
$payer->name="Lalo";
$payer->surname="Landa";
$payer->email="test_user_63274575@testuser.com";

$payer->phone = array(
    "area_code" => "False",
    "number" => 22223333,
  );


$payer->address = array(
    "street_name" => "False",
    "street_number" => 123,
    "zip_code" => "1111"
  );

$preference->payer=$payer;

$back_url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"]."/return.php";

$notification_url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"]."/notifications.php";


if (file_exists($_POST["img"]))
{
	$image = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"].substr($_POST["img"],1);
}else{
	$image = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER["HTTP_HOST"]."/assets/no-image.png";
}



// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->id=1234;
$item->title = $_POST["title"];
$item->description="Dispositivo móvil de Tienda e-commerce";
$item->quantity = 1;
$item->image=$image;
$item->unit_price = number_format($_POST["price"],2,".","");
$preference->items = array($item);

    $preference->back_urls=[
        'success'=>$back_url."?action=success",
        'pending'=>$back_url."?action=pending",
        'failure'=>$back_url."?action=failure",
    ];

$preference->external_reference="info@pasaviga.com.ar";

$preference->notification_url=$notification_url;

$preference->integrator_id="dev_24c65fb163bf11ea96500242ac130004";

$preference->payment_methods=["excluded_payment_types"=>[["id"=>"atm"],
														 ["id"=>"amex"]],
							  "installments"=>6];


$preference->save();

if ($preference->id)
{
	header("Location:".$preference->sandbox_init_point);
	exit();
}
echo "<pre>";
var_dump($preference);
echo "<pre>";
?>