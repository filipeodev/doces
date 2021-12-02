<?php 
namespace Src\Model\Dao;

use Src\Model\Domain\Pedido;

class PedidoDao{
	public function allPedidos():array{
		$sql = "SELECT * FROM pedido as p INNER JOIN usuario as u ON p.id_colaborador = u.id_usuario ";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}
	}
	public function allPedidosAV():array{
		$sql = "SELECT * FROM pedido as p INNER JOIN usuario as u ON p.id_colaborador = u.id_usuario WHERE p.status_pedido = 1 OR p.status_pedido = 2";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}
	}
	public static function allPedidosColaborador():array{
		$sql = "SELECT * FROM pedido WHERE id_colaborador = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $_SESSION['id_usuario']);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}
	}
	public function getPedidoId($pedido):string{
		$sql = "SELECT status_pedido FROM pedido WHERE id_pedido = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $pedido);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result[0]['status_pedido'];
		}else{
			return "";
		}
	}
	public function registerPedido(Pedido $pedido){
		$sql = "INSERT INTO pedido (id_colaborador, status_pedido, qtd_item, valor_total, data_pedido, id_produto) VALUES (?, ?, ?, ?, ?, ?)";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $pedido->getIdColaborador());
		$stmt->bindValue(2, $pedido->getStatusPedido());
		$stmt->bindValue(3, $pedido->getQtdItem());
		$stmt->bindValue(4, $pedido->getValorTotal());
		$stmt->bindValue(5, $pedido->getDataPedido());
		$stmt->bindValue(6, $pedido->getIdProduto());
		$stmt->execute();

		if($stmt->rowCount() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	public function alterarStatusPedidoId(Pedido $pedido):bool{
		$sql = "UPDATE pedido SET status_pedido = ? WHERE id_pedido = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $pedido->getStatusPedido());
		$stmt->bindValue(2, $pedido->getIdPedido());
		$stmt->execute();

		return $stmt->rowCount() > 0 ? true : false;
	}
}

?>