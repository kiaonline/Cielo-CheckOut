<?php
class Object{
	public function __call($method, $params) {

		$var = ucfirst(substr($method, 3));
		if (strncasecmp($method, "get", 3) === 0) {
			return $this->$var;
		}
		if (strncasecmp($method, "set", 3) === 0) {
			$this->$var = $params[0];
		}

		return $this;
	}
	public function jsonSerialize()
    {
        return get_object_vars($this);
	}
	public function toJson()
	{
		return json_encode($this);
	}
	   
}