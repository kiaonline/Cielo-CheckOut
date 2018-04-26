<?php
class Cart{
	var $Discount = array('Type'=>'Percent','Value'=>'00');
	var $Items = [];
	
	public function __construct()
	{
		return $this;
	}

	public function setDiscount($type,$value)
	{
		$this->Discount['Type'] 	= $type;
		$this->Discount['Value'] 	= $value;
		return $this;
	}

	function addItem(CartItem $item){
		$this->Items[] = $item;
		return $this;
	}
	
	public function createItem()
	{
		$newItem = new CartItem();
		$this->addItem($newItem);
		return $newItem;
	}

}
