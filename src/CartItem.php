<?php
class CartItem extends Object{
	var $Name 			=  'Unamed';
	var $UnitPrice		=  '100'; //R$1,00
	var $Quantity		=  1;
	var $Type			=  'Service'; //Asset, Digital, Service, Payment
	var $Description	=  NULL;
	var $Sku			=  NULL;
	var $Weight			=  NULL;


	
	public function __construct(){
		return $this;
	}

}