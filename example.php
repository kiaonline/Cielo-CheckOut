<?php
/**
 * Author: kiaonline
 * Diálogo Digital - dialogo.digital
 * https://github.com/kiaonline/Cielo-CheckOut
 */

error_reporting(E_ERROR);
ini_set('display_errors','On');
date_default_timezone_set('America/Sao_Paulo');

require_once('autoload.php');


$checkout 	= new CieloCheckOut();
$cart 		= $checkout->Cart
			->setDiscount('Percent','05')
			->createItem()
			->setName('Product Test #1')
			->setDescription('Description goes here! (Optionsl)');
			
$checkout->Shipping->setType('WithoutShipping');

$request        = new Request('xxxxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxx');
$response       = $request->send($checkout);

$checkOutUrl    = $response->settings->checkoutUrl;
header("Location:{$checkOutUrl}");
exit;
?>