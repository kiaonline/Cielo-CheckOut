<?php
/***
 * Class CieloCheckOut
 * Author: kiaonline
 * Diálogo Digital - dialogo.digital
 * https://github.com/kiaonline/Cielo-CheckOut
 * Cielo API 3.0
 * Cielo Manual: https://developercielo.github.io/manual/
 */
class CieloCheckOut extends Object{
	var $OrderNumber 	= null;
	var $SoftDescriptor = null;
	var $Cart 			= NULL;
	var $Shipping		= NULL;
	var $Payment		= NULL;
	var $Customer		= NULL;
	var $Options		= NULL;
	var $Settings		= NULL;

	public function __construct()
	{
		$this->Cart 		= new Cart();
		$this->Shipping 	= new Shipping();
		$this->Payment 		= new Payment();
		$this->Customer 	= new Customer();
		return $this;
	}
}