<?php
namespace Src\App;

class Message{
	const MESSAGE_ERROR = "ERRO";
	const MESSAGE_SUCCESS = "SUCCESS";

	//Mensagem de erro genérico
	public static function setME($msg){
		$_SESSION[Message::MESSAGE_ERROR] = $msg;
	}
	public static function getME():string{
		$msg = (isset($_SESSION[Message::MESSAGE_ERROR])) ? $_SESSION[Message::MESSAGE_ERROR] : '';

		Message::clearME();

		return $msg;
	}
	public static function clearME(){
		$_SESSION[Message::MESSAGE_ERROR] = null;
	}

	//Mensagem de sucesso genérico
	public static function setMS($msg){
		$_SESSION[Message::MESSAGE_SUCCESS] = $msg;
	}
	public static function getMS():string{
		$msg = (isset($_SESSION[Message::MESSAGE_SUCCESS])) ? $_SESSION[Message::MESSAGE_SUCCESS] : '';

		Message::clearMS();

		return $msg;
	}
	public static function clearMS(){
		$_SESSION[Message::MESSAGE_SUCCESS] = null;
	}
}
?>