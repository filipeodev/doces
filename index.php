<?php
ini_set('display_errors',1);
require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(ROOT);

$router->namespace("Src\App");

//Rotas de login e recupera senha
$router->group(null);
$router->get("/", "WebController:home");

//Rotas de autenticacao
$router->group("auth");
$router->post("/logon", "Auth:logon");
$router->get("/logoff", "Auth:logoff");

//Rotas do administrador
$router->group("admin");
$router->get("/", "AdminController:home");
$router->get("/usuarios", "AdminController:usuarios");
$router->get("/cadastrar-usuario", "AdminController:cadastrarUsuario");
$router->get("/editar-usuario/{id_usuario}", "AdminController:editarUsuario");
$router->post("/alterar-usuario/{id_usuario}", "AdminController:alterarUsuario");
$router->post("/register", "AdminController:register");
$router->get('/estoque', 'AdminController:estoque');
$router->get('/novo-mes', 'AdminController:novoMes');
$router->post('/novo-mes', 'AdminController:cadastrarMes');
$router->get('/gerenciar-compras/{id_mes}', 'AdminController:gerenciarEstoque');
$router->post('/criar-compra', 'AdminController:criarCompra');
$router->get('/cadastrar-itens/{id_mes}/{id_compra}', 'AdminController:cadastrarItens');
$router->get('/deletar-compra/{id_mes}/{id_compra}', 'AdminController:deletarCompra');
$router->post('/criar-item', 'AdminController:criarItem');
$router->get('/deletar-item/{id_mes}/{id_compra}/{id_item}', 'AdminController:deletarItem');
$router->get('/produtos', 'AdminController:criarProduto');
$router->get('/novo-produto', 'AdminController:novoProduto');
$router->post('/cadastrar-produto', 'AdminController:cadastrarProduto');
$router->post('/alterar-produto', 'AdminController:postAlterarProduto');
$router->get('/alterar-produto/{id_produto}', 'AdminController:alterarProduto');
$router->get('/deletar/{id_produto}', 'AdminController:deletarProduto');
$router->get('/pedidos', 'AdminController:pedidos');
$router->get('/retorna-pedidos', 'AdminController:retornaPedidos');
$router->get('/retorna-pedido/{id_pedido}', 'AdminController:retornaPedidoId');
$router->post('/alterar-status-pedido/{id_pedido}', 'AdminController:alterarStatusPedidoId');

//Rotas do colaborador
$router->group("colaborador");
$router->get('/', 'ColaboradorController:home');
$router->get('/meus-pedidos', 'ColaboradorController:meusPedidos');
$router->get('/novo-pedido', 'ColaboradorController:novoPedido');
$router->post('/novo-pedido', 'ColaboradorController:cadastrarNovoPedido');
$router->get('/retorna-pedidos', 'ColaboradorController:retornaPedidos');
// Erros
$router->group("erro");
$router->get("/{errcode}","WebController:error" );

$router->dispatch();

if($router->error()){
	$router->redirect("/erro/{$router->error()}");
}
?>