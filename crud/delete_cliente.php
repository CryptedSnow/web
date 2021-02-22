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
	<title> DELETE | CLIENTE </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botão de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variável
			$cd_cliente = intval($_POST['cd_cliente']);
			// Se a remoção for possível de realizar
			try {
			    // Query que faz a remoção
			    $remove = "DELETE FROM cliente WHERE cd_cliente = :cd_cliente";
			    // $remocao recebe $conexao que prepare a operação de exclusão
			    $remocao = $conexao->prepare($remove);
			    // Recebendo referencias e valores como argumento
			    $remocao->bindValue(':cd_cliente', $cd_cliente);
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