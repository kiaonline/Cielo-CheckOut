<?php
class Shipping extends Object{
	var $SourceZipCode 	= NULL;
	var $TargetZipCode 	= NULL;
	//FixedAmount
	var $Type 			= NULL;
	var $Services 		= [];
	var $Address		= NULL;

	public function __construct(){
		return $this;
	}

	function setAddress(Array $address){
		$this->Address = new Address($address);
		return $this;
	}

	function addService(Service $service){
		$this->Services[] = $service;
		return $this;
	}
	
	public function createService()
	{
		$newService = new Service();
		$this->addService($newService);
		return $newService;
	}

}