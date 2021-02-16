<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> INSERT | FORNECEDOR </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';  
		// Se existir o botao de Inserir
		if(isset($_POST['Inserir'])){
			// Especifica a variavel
			$nome = $_POST['nome'];
			$cnpj = $_POST['cnpj'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$estado = $_POST['estado'];
			$cidade = $_POST['cidade'];
			$bairro = $_POST['bairro'];
			$endereco = $_POST['endereco'];
			$numero = intval($_POST['numero']);
			// Se a insercao for possivel de realizar
			try {
				// Query que faz a insercao
				$insercao = "INSERT INTO fornecedor (nome,cnpj,telefone,email,estado,cidade,bairro,endereco,numero) 
				VALUES (:nome,:cnpj,:telefone,:email,:estado,:cidade,:bairro,:endereco,:numero)";
				// $insere_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':nome',$nome);
				$insere_dados->bindValue(':cnpj',$cnpj);
				$insere_dados->bindValue(':telefone',$telefone);
				$insere_dados->bindValue(':email',$email);
				$insere_dados->bindValue(':estado',$estado);
				$insere_dados->bindValue(':cidade',$cidade);
				$insere_dados->bindValue(':bairro',$bairro);
				$insere_dados->bindValue(':endereco',$endereco);
				$insere_dados->bindValue(':numero',$numero);
				// Executa a operacao
				$insere_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_fornecedor.php');
			// Se a insercao nao for possivel de realizar
			} catch (PDOException $falha_insercao) {
			    echo "A inserção não foi feita".$falha_insercao->getMessage();
			    die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_insert_fornecedor.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>