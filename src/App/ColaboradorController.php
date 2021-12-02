<?php 
namespace Src\App;

use Src\View\ToView;
use Src\App\Message;
use Src\Model\Domain\Pedido;
use Src\Model\Domain\Produto;
use Src\Model\Dao\PedidoDao;
use Src\Model\Dao\ProdutoDao;

class ColaboradorController{
	public function __construct(){
		$link = url();
		if(!$_SESSION){
			session_destroy();
			header('Location:'.$link);
		}
		if($_SESSION['tipo_u'] != 'func'){
			session_destroy();
			header('Location:'.$link);
		}
	}
	public function home(){
		try {
			$toView = new ToView(URL_VIEW_COLAB);
			$toView->viewStandard('home');
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function meusPedidos(){
		try{
			$toView = new ToView(URL_VIEW_COLAB);
			$msg = new Message();
			$pedidos = PedidoDao::allPedidosColaborador();

			$data = [$msg->getMS(), $msg->getME(), $pedidos];
			$toView->viewStandard('meus-pedidos', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function novoPedido(){
		try {
			$toView = new ToView(URL_VIEW_COLAB);
			$msg = new Message();
			$produtoDao = new ProdutoDao();

			$data = [$msg->getME(), $produtoDao->allProdutos()];
			$toView->viewStandard('novo-pedido', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function cadastrarNovoPedido($data){
		try {
			$msg = new Message();
			$pedido = new Pedido();
			$pedidoDao = new PedidoDao();
			$produto = new Produto();
			$produtoDao = new ProdutoDao();

			$pedido->setStatusPedido(1);
			$pedido->setQtdItem($data["quantidade"]);
			$pedido->setIdColaborador($_SESSION['id_usuario']);
			$pedido->setDataPedido(generateDate());
			$valorTrufa = $produtoDao->retornaProdutoId($data['id-produto']);
			$valorTotal = floatval($valorTrufa[0]['valor_total']) * floatval($data["quantidade"]);
			$pedido->setValorTotal($valorTotal);
			$pedido->setIdProduto($data['id-produto']);

			if($pedidoDao->registerPedido($pedido) > 0){
				$msg->setMS('Pedido cadastrado com sucesso.');
				header('Location:'.url('colaborador/meus-pedidos'));
			}else{
				$msg->setME('Erro ao cadastrar pedido.');
				header('Location:'.url('colaborador/novo-pedido'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	public function retornaPedidos(){
		try {
			$pedidoDao = new PedidoDao();
			$allPedidos = $pedidoDao->allPedidos();
			$callback['dados'] = $allPedidos;
			echo json_encode($callback);
		} catch (Exception $e) {
			throw $e;
		}
	}
}
 ?>
