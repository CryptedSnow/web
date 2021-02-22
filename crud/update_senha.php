<?php
	// Arquivo conexao.php
	require_once '../conexao/conexao.php'; 
	// Arquivo classe_usuario.php
	require_once '../classe/classe_usuario.php';
	// Inicio da sessao
	session_start();
	// Se existir $_SESSION['id_usuario'] e nao for vazio
	if((isset($_SESSION['id_usuario'])) && (!empty($_SESSION['id_usuario']))){
		// Mensagem
		echo "";
	// Se nao
	} else {
		// Retorna para a pagina index.php
		echo "<script> alert('Ação inválida, entre no sistema da maneira correta.'); location.href='/web/index.php' </script>";
		die;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> UPDATE | SENHA </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variavel 
			$cd_funcionario = intval($_POST['cd_funcionario']);
			$senha_atual = strval($_POST['senha']); 
			$senha_nova = strval($_POST['senha_nova']);
			$confirmar_senha_nova = strval($_POST['confirmar_senha_nova']);
			// Query que seleciona chave e nome do funcionario
			$selecao = $conexao->prepare("SELECT * FROM funcionario WHERE cd_funcionario = :cd_funcionario LIMIT 1");
			// Especifica a variavel
			$selecao->bindValue(":cd_funcionario", $cd_funcionario);
			// Executa a operacao
			$selecao->execute();
			// Retorna uma matriz contendo todas as linhas do conjunto de resultados
			$linhas = $selecao->fetch(PDO::FETCH_ASSOC);
			// Query que recebe a matriz das senhas			
			$senha_mysql = $linhas['senha'];
			$usuario_nome = $linhas['nome'];
			// Se a atualizacao da senha for possivel de realizar
			try {
				// Se a $senha_atual for diferente de $senha_mysql ou a $senha_nova for diferente de $confirmar_senha
				if (!password_verify($senha_atual, $senha_mysql) || ($senha_nova != $confirmar_senha_nova)){
					// Mensagem
					echo "{$usuario_nome}, algo deu errado na atualização de sua senha, refaça novamente a operação.";
					echo '<p><a href="../form_crud/form_update_senha.php"><button>Refazer operação</button></a></p>';
				// Se nao
				} else {
                    // Cria uma senha com password_hash onde seu comprimento muda de acordo com o tempo
					$confirmar_senha_nova = password_hash($confirmar_senha_nova, PASSWORD_DEFAULT);
					// $update realiza a operacao de atualizar a senha do funcionario
					$update = $conexao->prepare("UPDATE funcionario SET senha = :nova_senha WHERE cd_funcionario = :cd_funcionario");
                    // Vincula o valor a um parametro
					$update->bindValue(":nova_senha", $confirmar_senha_nova);
					$update->bindValue(":cd_funcionario", $cd_funcionario);
					// Executa a operacao
					$update->execute();
					// Mensagem
					echo "{$usuario_nome}, sua senha foi atualizada com sucesso!";
					echo '<p><a href="../form_crud/form_update_senha.php"><button>Retornar operação</button></a></p>';
				}
			// Se a atualizacao da senha nao for possivel de realizar	
			} catch (PDOException $falha_alteracao) {
				echo "A alteração da senha não foi feita".$falha_alteracao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista	
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_update_senha.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		}
	?>
</body>
</html>