<?php
namespace Src\Model\Domain;

class Usuario{
	private $id, $nome, $email, $senha, $status, $tipo, $urlFoto;

	public function setId($id){
		$this->id = $id;
	}
	public function getId(){
		return $this->id;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getSenha(){
		return $this->senha;
	}

	public function setStatus($status){
		$this->status = $status;
	}
	public function getStatus(){
		return $this->status;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	public function getTipo(){
		return $this->tipo;
	}

	public function setUrlFoto($urlFoto){
		$this->urlFoto = $urlFoto;
	}
	public function getUrlFoto(){
		return $this->urlFoto;
	}
}
?>