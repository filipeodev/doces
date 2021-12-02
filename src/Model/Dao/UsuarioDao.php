<?php
namespace Src\Model\Dao;

use Src\Model\Domain\Usuario;
use Src\App\Message;

class UsuarioDao{

	//Realiza o login
	public function login(Usuario $user):array{

		try {

			if(UsuarioDao::verificaSenhaCorreta($user->getSenha(), $user->getNome()) == 1){
				$sql = "SELECT * FROM usuario WHERE nome = ? OR email = ?";

				$stmt = Conexao::getConn()->prepare($sql);
				$stmt->bindValue(1, $user->getNome());
				$stmt->bindValue(2, $user->getNome());
				$stmt->execute();

				if($stmt->rowCount() > 0){
					$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
					return $result;
				}else{
					return [];
				}
			}else{
				return [];
			}
		} catch (Exception $e) {
			throw $e;
			
		}
	}

	//Verifica se senha está correta
	public static function verificaSenhaCorreta($senha, $email):int{
		$sql = "SELECT * FROM usuario WHERE nome = ? OR email = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $email);
		$stmt->bindValue(2, $email);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$data = $stmt->fetchAll(\PDO::FETCH_ASSOC);

			if(password_verify($senha, $data[0]['senha'])){
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}

	}

	//retorna todos os usuarios
	public function retornaTodos():array{
		try {
			$sql = "SELECT * FROM usuario";

			$stmt = Conexao::getConn()->prepare($sql);
			$stmt->execute();

			if($stmt->rowCount() > 0){
				$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
				return $result;
			}else{
				return [];
			}
		} catch (Exception $e) {
			throw $e;
			
		}
	}

	//retonar uma senha hash
	public static function senhaHash($senha):string{
		return password_hash($senha, PASSWORD_DEFAULT, [
			'cost'=>12
		]);
	}

	//Verifica se o usuário/email exitem;
	public static function usuarioEmailExitem($nome, $email):int{
		$sql = "SELECT * FROM usuario WHERE nome = ? OR email = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $email);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			//TEM retorna 1
			return 1;
		}else{
			//NÃO TEM retorna 0
			return 0;
		}
	}

	//Cadastra o usuario
	public function registrarUsuario(Usuario $user):int{

		try {

			if(UsuarioDao::usuarioEmailExitem($user->getNome(), $user->getEmail()) == 1){
				//Caso a consulta me retorne que TENHA usuario
				return 1;
			}else{
				$sql = "INSERT INTO usuario (nome, email, senha, status_u, tipo_u, url_foto) VALUES (?, ?, ?, ?, ?, ?)";

				$senha = UsuarioDao::senhaHash($user->getSenha());
				if($user->getStatus() == 'A'){
					$status = 1;
				}else{
					$status = 2;
				}

				$stmt = Conexao::getConn()->prepare($sql);
				$stmt->bindValue(1, $user->getNome());
				$stmt->bindValue(2, $user->getEmail());
				$stmt->bindValue(3, $senha);
				$stmt->bindValue(4, $status);
				$stmt->bindValue(5, $user->getTipo());
				$stmt->bindValue(6, $user->getUrlFoto());
				$stmt->execute();

				return 0;
			}
			
		} catch (Exception $e) {
			throw $e;
		}
	}
	//alterar o usuario
	public function alterarUsuario(Usuario $user):int{
		$sql = "UPDATE usuario SET status_u = ?, tipo_u = ? WHERE id_usuario = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $user->getStatus());
		$stmt->bindValue(2, $user->getTipo());
		$stmt->bindValue(3, $user->getId());
		$stmt->execute();

		if($stmt->rowCount() > 0){
			return 1;
		}else{
			return 0;
		}
	}

	//Retorna usuario pelo id para ser alterado
	public function retornaUsuarioId(Usuario $user):array{
		$sql = "SELECT * FROM usuario WHERE id_usuario = ?";

		$stmt = Conexao::getConn()->prepare($sql);
		$stmt->bindValue(1, $user->getId());
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
			return $result;
		}else{
			return [];
		}
	}
}
?>