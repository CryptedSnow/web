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
	<title> DELETE | DEVOLUÇÃO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variavel
			$cd_devolucao = intval($_POST['cd_devolucao']);
			// Se a remocao for possivel de realizar
			try {
			    // Query que faz a remocao
			    $remove = "DELETE FROM devolucao WHERE cd_devolucao = :cd_devolucao";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Recebendo referencias e valores como argumento
			    $remocao->bindValue(':cd_devolucao', $cd_devolucao);
			    // Executa a operacao
			    $remocao->execute();
        		// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_devolucao/#nome.php');
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
			echo '<p><a href="../form_crud/form_delete_devolucao.php/#cad_dev" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>