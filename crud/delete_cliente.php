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
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
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
			// Buscar nome do cliente
			$procurar_nome = "SELECT nome FROM cliente WHERE cd_cliente = :cd_cliente";
			$busca_nome = $conexao->prepare($procurar_nome);
			$busca_nome->bindValue(':cd_cliente', $cd_cliente);
			$busca_nome->execute();
			$linha_nome = $busca_nome->fetch(PDO::FETCH_ASSOC);
			$nome_cliente = $linha_nome['nome'];
			// Query que verifica se existe o registro de cliente em venda
			$procurar_cliente = "SELECT COUNT(cd_cliente) AS countCliente FROM venda WHERE cd_cliente = :cd_cliente";
			$busca_cliente = $conexao->prepare($procurar_cliente);
			$busca_cliente->bindValue(':cd_cliente',$cd_cliente);
			$busca_cliente->execute();
			$linha = $busca_cliente->fetch(PDO::FETCH_ASSOC);
			$countCliente = $linha['countCliente'];
			// Se o registro de cliente existir na tabela venda 
			if ($countCliente > 0) {
				$pluralSingular = $countCliente == 1 ? "uma venda" : "$countCliente vendas";
				echo "Você não pode apagar {$nome_cliente} do sistema, pois está registrado em $pluralSingular.";
				echo '<p><a href="../form_crud/form_delete_cliente.php/#exc_cli" 
				title="Refazer operação"><button>Botão refazer operação</button></a></p>';
				exit;
			}
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
				header('Location: ../form_crud/form_select_cliente.php/#nome');
				die();
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
			echo '<p><a href="../form_crud/form_delete_cliente/#exc_cli.php" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>