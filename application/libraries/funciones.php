<?php 

class funciones

{

	function __construct ()

	{

		$this->CI =& get_instance();

	}	

	public function RandomCaracteres($cant) {
		$salt = "abchefghjkmnpqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass ='';
		while ($i <= $cant) {
			$num = rand() % 59;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		return $pass;
	}
}
?>