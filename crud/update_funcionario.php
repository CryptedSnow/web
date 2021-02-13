<!DOCTYPE html>
<html>
<head>
	<title> UPDATE | FUNCIONÁRIO </title>
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';  
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variavel 
			$cd_funcionario = $_POST['cd_funcionario'];
			$nome = $_POST['nome'];
			$cpf = $_POST['cpf'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			// Se a atualizacao for possivel de realizar
			try {
				// Query que faz a atualizacao
				$atualizacao = "UPDATE funcionario SET nome = :nome, cpf = :cpf, 
				telefone = :telefone, email = :email WHERE cd_funcionario = :cd_funcionario";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_funcionario',$cd_funcionario);
				$atualiza_dados->bindValue(':nome',$nome);
			    $atualiza_dados->bindValue(':cpf',$cpf);
			    $atualiza_dados->bindValue(':telefone',$telefone);
			    $atualiza_dados->bindValue(':email',$email);
			    // Executa a operacao
			    $atualiza_dados->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_funcionario.php');	
			// Caso a atualizacao for possivel de realizar
			} catch (PDOException $falha_atualizacao) {
			    echo "A atualização não foi feita".$falha_atualizacao->getMessage();
			    die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_update_funcionario.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>