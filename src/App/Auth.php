<?php
namespace Src\App;

use Src\Model\Domain\Usuario;
use Src\Model\Dao\UsuarioDao;
use Src\App\Message;

class Auth{

	public function logon($data):void{
		try {
			$msg = new Message();
			$usuario = new Usuario();
			$usuario->setNome($data['email']);
			$usuario->setSenha($data['senha']);

			$usuarioDao = new UsuarioDao();
			$result = $usuarioDao->login($usuario);

			if(count($result) > 0){
				if($result[0]['status_u'] == '2'){
					$msg->setME('Usuário desativado, contate administrador.');
					header('Location:'.url());
					exit();
				}else{
					$_SESSION['id_usuario'] = $result[0]['id_usuario'];
					$_SESSION['nome'] = $result[0]['nome'];
					$_SESSION['email'] = $result[0]['email'];
					$_SESSION['status_u'] = $result[0]['status_u'];
					$_SESSION['tipo_u'] = $result[0]['tipo_u'];
					$_SESSION['url_foto'] = $result[0]['url_foto'];

					switch ($result[0]['tipo_u']) {
						case 'admin':
							$uri = 'admin';
							break;

						case 'func':
							$uri = 'colaborador';
							break;
						
						default:
							$uri = 'auth/logoff';
							break;
					}
					header('Location:'.url($uri));
				}
			}else{
				$msg->setME('Usuario ou Senha não confere!');
				header('Location:'.url());
				exit();
			}

		} catch (Exception $e) {
			throw $e;
		}
	}

	public function logoff(){
		try {
			session_destroy();
			header('Location:'.url());
		} catch (Exception $e) {
			throw $e;
			
		}
	}
}
?>