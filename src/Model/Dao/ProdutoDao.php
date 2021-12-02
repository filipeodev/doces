<?php 
namespace Src\Model\Dao;

use Src\Model\Domain\Produto;

class ProdutoDao{
	public function cadastrarProduto(Produto $produto):int{
		if($produto->getIdProduto() == 0){
			$sql = "INSERT INTO produto (nome_produto, valor_total, ganho_colaborador, ganho_empresa) VALUES (?, ?, ?, ?)";

			$stmt = Conexao::getConn()->prepare($sql);
			$stmt->bindValue(1, $produto->getNomeProduto());
			$stmt->bindValue(2, $produto->getValorTotal());
			$stmt->bindValue(3, $produto->getGanhoColaborador());
			$stmt->bindValue(4, $produto->getGanhoEmpresa());
			$stmt->execute();

			return $stmt->rowCount() > 0 ? 1 : 0;
		}else{
			$sql = "UPDATE produto SET nome_produto = ?, valor_total = ?, ganho_colaborador = ?, ganho_empresa = ? WHERE id_produto = ?";

			$stmt = Conexao::getConn()->prepare($sql);
			$stmt->bindValue(1, $produto->getNomeProduto());
			$stmt->bindValue(2, $produto->getValorTotal());
			$stmt->bindValue(3, $produto->getGanhoColaborador());
			$stmt->bindValue(4, $produto->getGanhoEmpresa());
			$stmt->bindValue(5, $produto->getIdProduto());
			$stmt->execute();

			return $stmt->rowCount() > 0 ? 1 : 0;
		}
	}
	public function allProdutos():array{
		$sql = "SELECT * FROM produto ORDER BY id_produto DESC";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->execute();

		return $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
	}
	public function retornaProdutoId($data):array{
		$sql = "SELECT * FROM produto WHERE id_produto = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $data);
		$stmt->execute();

		return $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
	}
	public function deletarProduto(Produto $produto){
		$sql = "DELETE FROM produto WHERE id_produto = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $produto->getIdProduto());
		$stmt->execute();

		return $stmt->rowCount() > 0 ? 1 : 0;
	}
}

?>