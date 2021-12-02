<?php
namespace Src\Model\Domain;

class ItemEstoque{
	private $id, $idMes, $idCompra, $item, $qtd, $valor, $data, $total;

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setIdMes($idMes){
		$this->idMes = $idMes;
	}
	public function getIdMes(){
		return $this->idMes;
	}

	public function setIdCompra($idCompra){
		$this->idCompra = $idCompra;
	}
	public function getIdCompra(){
		return $this->idCompra;
	}

	public function setItem($item){
		$this->item = $item;
	}
	public function getItem(){
		return $this->item;
	}

	public function setQtd($qtd){
		$this->qtd = $qtd;
	}
	public function getQtd(){
		return $this->qtd;
	}

	public function setValor($valor){
		$this->valor = $valor;
	}
	public function getValor(){
		return $this->valor;
	}

	public function setData($data){
		$this->data = $data;
	}
	public function getData(){
		return $this->data;
	}

	public function setTotal($total){
		$this->total = $total;
	}
	public function getTotal(){
		return $this->total;
	}
}
?>