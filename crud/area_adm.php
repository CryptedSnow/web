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
	// Caso o usuario atual seja diferente de ADM
	if ($_SESSION['cargo_usuario'] != "Administrador") {
		echo "<script> alert('Só o administrador pode acessar essa área.'); location.href='/web/inicio.php' </script>";
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
	<title> UPDATE | ÁREA ADMINISTRADOR </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Atualizar
		if(isset($_POST['Atualizar'])){
			// Especifica a variavel 
			$cd_funcionario = intval($_POST['cd_funcionario']);
			$cargo_atual = strval($_POST['cargo']);
			$novo_cargo = strval($_POST['novo_cargo']);
			// Se o cargo atual for igual ao novo cargo
			if ($cargo_atual == $novo_cargo) {
				echo "O novo cargo não pode ser igual ao antigo cargo, refaça a operação.";
				echo '<p><a href="../form_crud/form_area_adm.php/#area_adm" 
				title="Refazer operação"><button>Botão refazer operação</button></a></p>';
				exit;
			}
			// Se a atualizacao for possivel de realizar
			try {
				// Query que faz a atualizacao
				$atualizacao = "UPDATE funcionario SET cargo = :novo_cargo WHERE cd_funcionario = :cd_funcionario";
				// $atualiza_dados recebe $conexao que prepare a operacao de atualizacao
				$atualiza_dados = $conexao->prepare($atualizacao);
				// Vincula um valor a um parametro
				$atualiza_dados->bindValue(':cd_funcionario',$cd_funcionario);
				$atualiza_dados->bindValue(':novo_cargo', $novo_cargo);
			    // Executa a operacao
			    $atualiza_dados->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_funcionario.php');
				die();	
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
			echo '<p><a href="../form_crud/form_area_adm.php/#area_adm" 
			title="Refazer operação"><button>Botão refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>