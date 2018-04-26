<?php
class CieloError extends Object{
    private $Code;
    private $Message;
    
    public function __construct($message=null,$code=null)
	{
		$this->Message  = $message;
		$this->Code     = $code;
		return $this;
	}
}