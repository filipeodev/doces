<?php
namespace Src\Model\Dao;

use Src\Model\Domain\MesEstoque;

class MesEstoqueDao{
	//mostrar todos os meses
	public function todosOsMeses():array{
		$sql = "SELECT * FROM mes_estoque ORDER BY id_mes_estoque DESC";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}

	}
	//mostrar todas as compras
	public function todasAsCompras():array{
		$sql = "SELECT * FROM compras";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}

	}
	//cadastrar mês
	public function cadastrarMes(MesEstoque $mes):int{
		$sql = "INSERT INTO mes_estoque (mes, ano) VALUES (?, ?)";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $mes->getMes());
		$stmt->bindValue(2, $mes->getAno());
		$stmt->execute();

		if($stmt->rowCount() > 0){
			return 1;
		}else{
			return 0;
		}
	}
}
?>