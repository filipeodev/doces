<?php 
namespace Src\Model\Domain;

class Pedido{
	private $id_pedido ,$id_colaborador ,$id_admin ,$status_pedido ,$qtd_item ,$valor_total ,$data_pedido, $id_produto;

	public function setIdPedido($id_pedido){
		$this->id_pedido = $id_pedido;
	}
	public function getIdPedido(){
		return $this->id_pedido;
	}

	public function setIdColaborador($id_colaborador){
		$this->id_colaborador = $id_colaborador;
	}
	public function getIdColaborador(){
		return $this->id_colaborador;
	}

	public function setIdAdmin($id_admin){
		$this->id_admin = $id_admin;
	}
	public function getIdAdmin(){
		return $this->id_admin;
	}

	public function setStatusPedido($status_pedido){
		$this->status_pedido = $status_pedido;
	}
	public function getStatusPedido(){
		return $this->status_pedido;
	}

	public function setQtdItem($qtd_item){
		$this->qtd_item = $qtd_item;
	}
	public function getQtdItem(){
		return $this->qtd_item;
	}

	public function setValorTotal($valor_total){
		$this->valor_total = $valor_total;
	}
	public function getValorTotal(){
		return $this->valor_total;
	}

	public function setDataPedido($data_pedido){
		$this->data_pedido = $data_pedido;
	}
	public function getDataPedido(){
		return $this->data_pedido;
	}

	public function setIdProduto($id_produto){
		$this->id_produto = $id_produto;
	}
	public function getIdProduto(){
		return $this->id_produto;
	}
}
?>
