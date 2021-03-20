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
	<title> DELETE | FORNECEDOR </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){	
			// Especifica a variavel
			$cd_fornecedor = intval($_POST['cd_fornecedor']);
			// Buscar nome do fornecedor
			$procurar_nome = "SELECT nome FROM fornecedor WHERE cd_fornecedor = :cd_fornecedor";
			$busca_nome = $conexao->prepare($procurar_nome);
			$busca_nome->bindValue(':cd_fornecedor', $cd_fornecedor);
			$busca_nome->execute();
			$linha_nome = $busca_nome->fetch(PDO::FETCH_ASSOC);
			$nome_fornecedor = $linha_nome['nome'];
			// Query que verifica se existe o registro de fornecedor em compra
			$procurar_forn = "SELECT COUNT(cd_fornecedor) AS countForn 
			FROM compra_fornecedor WHERE cd_fornecedor = :cd_fornecedor";
			$busca_forn = $conexao->prepare($procurar_forn);
			$busca_forn->bindValue(':cd_fornecedor',$cd_fornecedor);
			$busca_forn->execute();
			$linha = $busca_forn->fetch(PDO::FETCH_ASSOC);
			$countForn = $linha['countForn'];
			// Se o registro de fornecedor existir na tabela compra 
			if ($countForn > 0) {
				$pluralSingular = $countForn == 1 ? "uma compra" : "$countForn compras";
				echo "Você não pode apagar {$nome_fornecedor} do sistema, pois está registrado em $pluralSingular.";
				echo '<p><a href="../form_crud/form_delete_fornecedor.php/#exc_forn" 
				title="Refazer operação"><button>Botão refazer operação</button></a></p>';
				exit;
			}
			// Se a remocao for possivel de realizar
			try {
			   // Query que faz a remocao
			    $remove = "DELETE FROM fornecedor WHERE cd_fornecedor = :cd_fornecedor";
			    // $remocao recebe $conexao que prepare a operação de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
			    $remocao->bindValue(':cd_fornecedor', $cd_fornecedor);
			    // Executa a operacao
			    $remocao->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_fornecedor.php/#nome');
				die();
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
			echo '<p><a href="../form_crud/form_delete_fornecedor/#exc_forn.php" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>