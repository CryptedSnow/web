<!DOCTYPE html>
<html>
<head>
	<title> DELETE | CLIENTE </title>
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php';  
		// Se existir o botão de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variável
			$cd_cliente = $_POST['cd_cliente'];
			// Se a remoção for possível de realizar
			try {
			    // Query que faz a remoção
			    $remove = "DELETE FROM cliente WHERE cd_cliente = :cd_cliente";
			    // $remocao recebe $conexao que prepare a operação de exclusão
			    $remocao = $conexao->prepare($remove);
			    // Recebendo referencias e valores como argumento
			    $remocao->bindValue(':cd_cliente',$cd_cliente);
			    // Executa a operação
			    $remocao->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_cliente.php');
			// Se a remoção não for possível de realizar
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
			echo '<p><a href="../form_crud/form_delete_cliente.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>