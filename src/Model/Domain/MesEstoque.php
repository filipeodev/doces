<?php
namespace Src\Model\Domain;

class MesEstoque{
	private $id, $mes, $ano;

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setMes($mes){
		$this->mes = $mes;
	}
	public function getMes(){
		return $this->mes;
	}

	public function setAno($ano){
		$this->ano = $ano;
	}
	public function getAno(){
		return $this->ano;
	}
}
?>