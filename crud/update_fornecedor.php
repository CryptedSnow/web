<!DOCTYPE html>
<html>
<head>
	<title> UPDATE | FORNECEDOR </title>
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php'; 
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){	
			// Especifica a variavel
			$cd_fornecedor = $_POST['cd_fornecedor'];
			$nome = $_POST['nome'];
			$cnpj = $_POST['cnpj'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$estado = $_POST['estado'];
			$cidade = $_POST['cidade'];
			$bairro = $_POST['bairro'];
			$endereco = $_POST['endereco'];
			$numero = intval($_POST['numero']);
			// Se a atualizacao for possivel de realizar
			try {
				// Query que faz a atualizacao
				$atualizacao = "UPDATE fornecedor SET nome = :nome, cnpj = :cnpj, 
				telefone = :telefone, email = :email, estado = :estado, cidade = :cidade,
				bairro = :bairro, endereco = :endereco, numero = :numero 
				WHERE cd_fornecedor = :cd_fornecedor";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_fornecedor',$cd_fornecedor);
				$atualiza_dados->bindValue(':nome',$nome);
			    $atualiza_dados->bindValue(':cnpj',$cnpj);
			    $atualiza_dados->bindValue(':telefone',$telefone);
			    $atualiza_dados->bindValue(':email',$email);
			    $atualiza_dados->bindValue(':estado',$estado);
			    $atualiza_dados->bindValue(':cidade',$cidade);
			    $atualiza_dados->bindValue(':bairro',$bairro);
			    $atualiza_dados->bindValue(':endereco',$endereco);
			    $atualiza_dados->bindValue(':numero',$numero);
			    // Executa a operacao
			    $atualiza_dados->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_fornecedor.php');	
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
			echo '<p><a href="../form_crud/form_update_fornecedor.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>