<?php 
namespace Src\Model\Domain;

class Produto{
	private $id_produto, $nome_produto, $valor_total, $ganho_colaborador, $ganho_empresa;

	public function setIdProduto($id_produto){
		$this->id_produto = $id_produto;
	}
	public function getIdProduto(){
		return $this->id_produto;
	}

	public function setNomeProduto($nome_produto){
		$this->nome_produto = $nome_produto;
	}
	public function getNomeProduto(){
		return $this->nome_produto;
	}

	public function setValorTotal($valor_total){
		$this->valor_total = $valor_total;
	}
	public function getValorTotal(){
		return $this->valor_total;
	}

	public function setGanhoColaborador($ganho_colaborador){
		$this->ganho_colaborador = $ganho_colaborador;
	}
	public function getGanhoColaborador(){
		return $this->ganho_colaborador;
	}

	public function setGanhoEmpresa($ganho_empresa){
		$this->ganho_empresa = $ganho_empresa;
	}
	public function getGanhoEmpresa(){
		return $this->ganho_empresa;
	}
}
?>
