<?php
namespace Src\App;

use Src\View\ToView;
use Src\App\Message;
use Src\Model\Domain\Usuario;
use Src\Model\Dao\UsuarioDao;
use Src\Model\Domain\MesEstoque;
use Src\Model\Dao\MesEstoqueDao;
use Src\Model\Domain\ItemEstoque;
use Src\Model\Dao\ItemEstoqueDao;
use Src\Model\Domain\Produto;
use Src\Model\Domain\Pedido;
use Src\Model\Dao\ProdutoDao;
use Src\Model\Dao\PedidoDao;

use League\Plates\Engine;

class AdminController{
	//Metodo construtor, verifica se tem sessão, se não direciona para home(login)
	public function __construct(){
		$link = url();
		if(!$_SESSION){
			session_destroy();
			header('Location:'.$link);
		}
		if($_SESSION['tipo_u'] != 'admin'){
			session_destroy();
			header('Location:'.$link);
		}
	}
	//rota da home
	public function home(){
		try {
			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('home');
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota do usuario, retorna mensagem como uma sessão e todos os usuários
	public function usuarios(){
		try {

			$usuarioDao = new UsuarioDao();
			$dados = $usuarioDao->retornaTodos();
			$msg = new Message();

			$data = [$msg->getME(), $msg->getMS(), $dados];

			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('usuarios', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota de cadastrado de usuario e leva uma mensagem por sessão
	public function cadastrarUsuario(){
		try {
			$msg = new Message();

			$data = [$msg->getME(), $msg->getMS()];
			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('cadastrar-usuario', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota de edição de usuario, leva os dados do usuario específico e  uma menasagem de erro por sessão
	public function editarUsuario($id){
		try {
			$msg = new Message();
			$usuario = new Usuario();
			$usuarioDao = new UsuarioDao();
			$usuario->setId($id['id_usuario']);

			$dados = $usuarioDao->retornaUsuarioId($usuario);
			$data = [$msg->getME(), $dados[0]];

			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('editar-usuario', $data);

		} catch (Exception $e) {
			throw $e;
		}
	}
		
	public function register($data){
		try {
			$upload = new \CoffeeCode\Uploader\Image('img', 'images');
			$files = $_FILES;
			if(!empty($files['url_foto'])){
				$file = $files['url_foto'];

				if(empty($file['type']) || !in_array($file['type'], $upload::isAllowed())){
					$file = 'templates/util/img/none.jpg';
				}else{
					$file = $upload->upload($file, pathinfo($file['name'], PATHINFO_FILENAME), 350);
				}
			}else{
				$file = 'templates/util/img/none.jpg';
			}
			$usuario = new Usuario();
			$usuario->setStatus($data['status']);
			$usuario->setNome($data['nome']);
			$usuario->setEmail($data['email']);
			$usuario->setSenha($data['senha']);
			$usuario->setTipo($data['tipo_u']);
			$usuario->setUrlFoto($file);

			$usuarioDao = new UsuarioDao();
			$ad = new AdminController();
			$msg = new Message();

			if($usuarioDao->registrarUsuario($usuario) == 0){
				$msg->setMS('Usuário cadastrado com sucesso.');

				header('Location:'.url('admin/usuarios'));
			}else{
				$msg->setME('Nome ou Email já cadastrado.');

				header('Location:'.url('admin/cadastrar-usuario'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota para editar usuario pelo post, cadastra e cria a mensagem levando para hota específica
	public function alterarUsuario($data){
		$usuario = new Usuario;
		$usuarioDao = new UsuarioDao();
		$msg = new Message();

		$usuario->setStatus($data['status']);
		$usuario->setTipo($data['tipo_u']);
		$usuario->setId($data['id_usuario']);

		if($usuarioDao->alterarUsuario($usuario) == 0){
			$msg->setME('Não foi possível alterar usuário.');

			header('Location:'.url('admin/editar-usuario'));
		}else{
			$msg->setMS('Usuário alterado com sucesso.');

			header('Location:'.url('admin/usuarios'));
		}
	}

	//rota que leva a home do estoque
	public function estoque(){
		try {
			$msg = new Message();
			$mes = new MesEstoqueDao();
			$data = [$msg->getMS(), $mes->todosOsMeses()];
			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('estoque', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota novo Mês
	public function novoMes(){
		try {
			$msg = new Message();
			$data = [$msg->getME()];
			$toView = new ToView(URL_VIEW_ADMIN);
			$toView->viewStandard('novo-mes', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//cadastrar novo Mês
	public function cadastrarMes($data){
		try {
			$msg = new Message();
			$mes = new MesEstoque();
			$mesDao = new MesEstoqueDao();

			$mes->setMes($data['mes']);
			$mes->setAno($data['ano']);

			if($mesDao->cadastrarMes($mes) == 1){
				$msg->setMS('Mês cadastrado com sucesso.');
				header('Location:'.url('admin/estoque'));
			}else{
				$msg->setME('Erro ao cadastrar mês.');
				header('Location:'.url('admin/novo-mes'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota para visualizar os item do estoque
	public function gerenciarEstoque($data){
		try {
			$msg = new Message();
			$itemDao = new ItemEstoqueDao();
			$toView = new ToView(URL_VIEW_ADMIN);

			$idMes = $data['id_mes'];

			$data = [$msg->getMS(), $idMes, $itemDao->todasAsComprasIdMes($idMes)];
			$toView->viewStandard('gerenciar-compras', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota para inserir dados da compra
	public function criarCompra($data){
		try {
			$msg = new Message();
			$compra = new ItemEstoque();
			$compraDao = new ItemEstoqueDao();
			
			$compra->setId($data['id_mes']);
			if(!empty($compraDao->cadastrarCompra($compra))){
				//retornou o item
				$ids = $compraDao->cadastrarCompra($compra);
				$msg->setMS('Compra Cadastrada.');
				header('Location:'.url('admin/cadastrar-itens/'.$ids[0]['id_mes_estoque'].'/'.$ids[0]['id_compra']));
			}else{
				//array vazio
				$msg->setME('Erro ao tentar criar compra. Tente novamente!');
				header('Location:'.url('admin/gerenciar-estoque/'.$data['id_mes']));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//rota para criar item
	public function cadastrarItens($data){
		try {
			$msg = new Message();
			$toView =  new ToView(URL_VIEW_ADMIN);
			$itemDao = new ItemEstoqueDao();

			$data = ['ms' => $msg->getMS(), 'me' => $msg->getME(), 'id_mes' => $data['id_mes'], 'id_compra' => $data['id_compra'], 'itens' => $itemDao->todasAsItemIdCompra($data['id_compra'])];
			$toView->viewStandard('cadastrar-itens', $data);
		} catch (Exception $e) {
			throw $e;
			
		}
	}
	//Deletar compra
	public function deletarCompra($data){
		$msg = new Message();
		$compra = new ItemEstoque();
		$compraDao = new ItemEstoqueDao();

		$compra->setIdMes($data["id_mes"]);
		$compra->setIdCompra($data["id_compra"]);

		if($compraDao->deletarCompra($compra) == 1){
			$msg->setMS('Compra excluída com sucesso.');
			header('Location:'.url('admin/gerenciar-compras/'.$data["id_mes"]));
		}else{
			$msg->setME('Erro ao excluir compra.');
			header('Location:'.url('admin/gerenciar-compra/'.$data["id_mes"]));
		}
	}
	//cadastrar item no banco
	public function criarItem($data){
		try {
			$msg = new Message();
			$item = new ItemEstoque();
			$itemDao = new ItemEstoqueDao();

			$valor = textForMoney($data['valor']);

			$total = floatval($valor) * $data['qtd'];

			$item->setItem($data['item']);
			$item->setValor(floatval($valor));
			$item->setQtd($data['qtd']);
			$item->setIdMes($data['id_compra']);
			$item->setTotal($total);

			if($itemDao->cadastrarItem($item)){
				$msg->setMS('Compra cadastrada.');
				header('Location:'.url('admin/cadastrar-itens/'.$data['id_mes'].'/'.$data['id_compra']));
			}else{
				$msg->setME('Erro ao cadastrar compra.');
				header('Location:'.url('admin/criar-compra/'.$data['id_mes']));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//Deletar item
	public function deletarItem($data){
		try {
			$msg = new Message();
			$item = new ItemEstoque();
			$itemDao = new ItemEstoqueDao();

			$item->setId($data['id_item']);
			$item->setIdMes($data['id_mes']);
			$item->setIdCompra($data['id_compra']);

			if($itemDao->deletarItem($item) == 1){
				$msg->setMS('Item excluído com sucesso.');
				header('Location:'.url('admin/cadastrar-itens/'.$data['id_mes'].'/'.$data['id_compra']));
			}else{
				$msg->setME('Erro ao excluir item');
				header('Location:'.url('admin/cadastrar-itens/'.$data['id_mes'].'/'.$data['id_compra']));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//pagina de todos os produto
	public function criarProduto(){
		try {
			$toView = new ToView(URL_VIEW_ADMIN);
			$msg = new Message();
			$produtoDao = new ProdutoDao();

			$data = [$msg->getMS(), $produtoDao->allProdutos()];

			$toView->viewStandard('produtos', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//Novo produto
	public function novoProduto(){
		try {
			$toView =  new ToView(URL_VIEW_ADMIN);
			$msg = new Message();

			$data = [$msg->getME() ];
			$toView->viewStandard('novo-produto', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//cadastrar novo produto
	public function cadastrarProduto($data){
		try {
			$msg = new Message();
			$produto = new Produto();
			$produtoDao = new ProdutoDao();

			$produto->setNomeProduto($data['nome']);
			$produto->setValorTotal(textForMoney($data['valor-total']));
			$produto->setGanhoColaborador(textForMoney($data['ganho-colaborador']));
			$produto->setGanhoEmpresa(textForMoney($data['ganho-empresa']));

			if($produtoDao->cadastrarProduto($produto)){
				$msg->setMS('Produto cadastrado com sucesso.');
				header('Location:'.url('admin/produtos'));
			}else{
				$msg->setME('Erro ao cadastrar produto');
				header('Location:'.url('admin/novo-produto'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//pagina de alterar produto
	public function alterarProduto($data){
		try {
			$toView = new ToView(URL_VIEW_ADMIN);
			$msg = new Message();
			$produtoDao = new ProdutoDao();
			$produto = $produtoDao->retornaProdutoId($data['id_produto']);

			$data = [$msg->getME(), $produto[0]];

			$toView->viewStandard('alterar-produto', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	//alterar produto
	public function postAlterarProduto($data){
		try {
			$msg = new Message();
			$produto = new Produto();
			$produtoDao = new ProdutoDao();

			$produto->setIdProduto($data['id_produto']);
			$produto->setNomeProduto($data['nome']);
			$produto->setValorTotal(textForMoney($data['valor-total']));
			$produto->setGanhoColaborador(textForMoney($data['ganho-colaborador']));
			$produto->setGanhoEmpresa(textForMoney($data['ganho-empresa']));

			if($produtoDao->cadastrarProduto($produto)){
				$msg->setMS('Produto cadastrado com sucesso.');
				header('Location:'.url('admin/produtos'));
			}else{
				$msg->setME('Erro ao cadastrar produto');
				header('Location:'.url('admin/novo-produto'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//deletar produto
	public function deletarProduto($data){
		try {
			$msg = new Message();
			$produto = new Produto();
			$produtoDao = new ProdutoDao();

			$produto->setIdProduto($data['id_produto']);

			if($produtoDao->deletarProduto($produto)){
				$msg->setMS('Mensagem excluída com sucesso.');
				header('Location:'.url('admin/produtos'));
			}else{
				$msg->setME('Erro ao excluir produto.');
				header('Location:'.url('admin/produtos'));
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	//todos os pedidos
	public function pedidos(){
		try {
			$toView = new ToView(URL_VIEW_ADMIN);
			$msg = new Message();

			$data = [$msg->getMS()];

			$toView->viewStandard('pedidos', $data);
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function retornaPedidos(){
		try {
			$pedidoDao = new PedidoDao();
			$allPedidos = $pedidoDao->allPedidosAV();
			$callback['dados'] = $allPedidos;
			echo json_encode($callback);
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function retornaPedidoId($data){
		try {
			$pedidoDao = new PedidoDao();
			$pedidoId = $pedidoDao->getPedidoId($data['id_pedido']);
			$callback['data'] = $pedidoId;
			echo json_encode($callback);
		} catch (Exception $e) {
			throw $e;
		}
	}
	public function alterarStatusPedidoId($data){
		try {
			$pedido = new Pedido();
			$pedidoDao = new PedidoDao();
			$msg = new Message();
			$pedido->setStatusPedido($data['status_pedido']);
			$pedido->setIdPedido($data['id_pedido']);

			if($pedidoDao->alterarStatusPedidoId($pedido) == true){
				$callback['dados'] = 1;
				// header('Location: '.url('admin/pedidos'));
				echo json_encode($callback);
			}else{
				$callback['dados'] = 0;
				// header('Location: '.url('admin/pedidos'));
				echo json_encode($callback);
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
}
?>