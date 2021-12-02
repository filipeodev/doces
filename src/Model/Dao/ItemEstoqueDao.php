<?php
namespace Src\Model\Dao;

use Src\Model\Domain\ItemEstoque;
use Src\App\Message;

class ItemEstoqueDao{
	//mostrar todas as compras
	public function todasAsComprasIdMes($idMes):array{
		$sql = "SELECT * FROM compra WHERE id_mes_estoque = ? ORDER BY id_compra DESC";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $idMes);
		$stmt->execute();

		return $stmt->rowCount() > 0 ? $stmt->fetchAll(\PDO::FETCH_ASSOC) : [];
	}
	//mostrar todos os itens
	public function todasAsItemIdCompra($idCompra):array{
		$sql = "SELECT a.id_item, a.item, a.quantidade,
				a.valor, a.id_compra, a.total, b.data_com 
				FROM item a INNER JOIN 
				compra b ON a.id_compra = b.id_compra
				WHERE a.id_compra = ? ORDER BY id_item DESC";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $idCompra);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}

	}
	//cadastrar compra
	public function cadastrarCompra(ItemEstoque $compra):array{
		$sql = "INSERT INTO compra (id_mes_estoque) VALUES (?)";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $compra->getId());
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = ItemEstoqueDao::buscaMes($compra->getId());
			return $result;
		}else{
			return [];
		}

	}
	//busca mes referente
	public static function buscaMes($mes){
		$sql = "SELECT * FROM compra WHERE id_mes_estoque = ? ORDER BY id_compra DESC LIMIT 1";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $mes);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}
	}
	//cadastrando item
	public function cadastrarItem(ItemEstoque $item):int{
		$sql = "INSERT INTO item (item, quantidade, valor, id_compra, total) VALUES (?, ?, ?, ?, ?)";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $item->getItem());
		$stmt->bindValue(2, $item->getQtd());
		$stmt->bindValue(3, $item->getValor());
		$stmt->bindValue(4, $item->getIdMes());
		$stmt->bindValue(5, $item->getTotal());
		$stmt->execute();

		return $stmt->rowCount() > 0 ? 1 : 0;

	}
	//Deletar uma compra
	public function deletarCompra(ItemEstoque $item):int{
		$sql = "DELETE FROM compra WHERE id_mes_estoque = ? AND id_compra = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $item->getIdMes());
		$stmt->bindValue(2, $item->getIdCompra());

		$stmt->execute();

		//estou verificando se exites (não deve mais existir)
		//se for menor que 0 é verdadeiro, ou seja, não existe
		return ItemEstoqueDao::verificaCompra($item->getIdMes(), $item->getIdCompra()) == true ? 1 : 0;
	}
	private static function verificaCompra($idMes, $idCompra):bool{
		$sql = "SELECT * FROM compra WHERE id_mes_estoque = ? AND id_compra = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $idMes);
		$stmt->bindValue(2, $idCompra);
		$stmt->execute();

		return $stmt->rowCount == 0;
	}
	//Deletar um item
	public function deletarItem(ItemEstoque $item):int{
		$sql = "DELETE FROM item WHERE id_compra = ? AND id_item = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $item->getIdCompra());
		$stmt->bindValue(2, $item->getId());

		$stmt->execute();

		return ItemEstoqueDao::verificaItem($item->getIdCompra(), $item->getId()) == true ? 1 : 0;
	}
	private static function verificaItem($idCompra, $idItem):bool{
		$sql = "SELECT * FROM item WHER id_compra = ? AND id_item = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $idCompra);
		$stmt->bindValue(2, $idItem);
		$stmt->execute();

		return $stmt->rowCount == 0;
	}
}
?>