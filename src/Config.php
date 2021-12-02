<?php

if(empty(session_start()))
{
	session_start();
}

define('ROOT', 'http://localhost:81/doces');
define("URL_VIEW_ADMIN", "../../templates/admin");
define("URL_VIEW_WEB", "../../templates/web");
define("URL_VIEW_COLAB", "../../templates/colaborador");

function url(string $uri = null): string
{
	if($uri)
	{
		return ROOT . "/{$uri}";
	}

	return ROOT;
}

function tranfData(string $data):string{
	if(count(explode("/",$data)) > 1){
		$data = substr($data, 0, 10);
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
    	$data = substr($data, 0 ,10);
        return implode("/",array_reverse(explode("-",$data)));
    }
}
function generateDate():string{
	$today = getdate();
	$dia = '';
	$mes = '';
	$ano = $today['year'];
	if($today['mon'] > 10 || $today['mday'] > 10){
		$dia = '0'+$today['mday'];
		$mes = '0'+$today['mon'];
	}
	$today = $ano.'-'.$mes.'-'.$dia;
	return $today;
}

function textForMoney($data):string{
	$valor = str_replace(',', '.', $data);
	return $valor;
}

?>