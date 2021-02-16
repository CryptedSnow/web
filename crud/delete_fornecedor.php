<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> DELETE | FORNECEDOR </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';  
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){	
			// Especifica a variavel
			$cd_fornecedor = $_POST['cd_fornecedor'];
			// Se a remocao for possivel de realizar
			try {
			   // Query que faz a remocao
			    $remove = "DELETE FROM fornecedor WHERE cd_fornecedor = :cd_fornecedor";
			    // $remocao recebe $conexao que prepare a operação de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
			    $remocao->bindValue(':cd_fornecedor',$cd_fornecedor);
			    // Executa a operacao
			    $remocao->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_fornecedor.php');
			// Se a remocao nao for possivel de realizar
			} catch (PDOException $falha_remocao) {
			    echo "A remoção não foi feita".$falha_remocao->getMessage();
			    die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_delete_fornecedor.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>