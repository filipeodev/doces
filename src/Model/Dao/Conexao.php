<?php
namespace Src\Model\Dao;

class Conexao{
	private static $instance;

	public static function getConn(){
		if(!isset(self::$instance)){
			self::$instance = new \PDO('mysql:host=localhost;dbname=doces', 'root', '');
		}

		return self::$instance;
	}
}
?>