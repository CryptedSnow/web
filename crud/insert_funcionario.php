<!DOCTYPE html>
<html>
<head>
	<title> INSERT | FUNCIONÁRIO </title>
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';
		// Se existir o botao de Inserir
		if (isset($_POST['Inserir'])) {
			// Especifica a variavel
			$nome = $_POST['nome'];
			$cpf = $_POST['cpf'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
			// Se a insercao for possivel de realizar
			try {
				// Query que faz a insercao
				$insercao = "INSERT INTO funcionario (nome,cpf,telefone,email,senha) 
				VALUES (:nome,:cpf,:telefone,:email,:senha)";
				// $insere_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':nome', $nome);
				$insere_dados->bindValue(':cpf', $cpf);
				$insere_dados->bindValue(':telefone', $telefone);
				$insere_dados->bindValue(':email', $email);
				$insere_dados->bindValue(':senha', $senha);
				// Executa a operacao
				$insere_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_funcionario.php');
				// Se a insercao nao for possivel de realizar
			} catch (PDOException $falha_insercao) {
				echo "A inserção não foi feita" . $falha_insercao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_insert_funcionario.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>