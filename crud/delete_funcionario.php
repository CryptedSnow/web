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
	<title> DELETE | FUNCIONÁRIO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variavel
			$cd_funcionario = intval($_POST['cd_funcionario']);

			// Vai buscar o nome e cargo de gerente pela chave do funcionario
			$procurar_cargo = "SELECT nome, cargo FROM funcionario WHERE cd_funcionario = :cd_funcionario";
			$busca_cargo = $conexao->prepare($procurar_cargo);
			$busca_cargo->bindValue(':cd_funcionario', $cd_funcionario);
			$busca_cargo->execute();
			$linha = $busca_cargo->fetch(PDO::FETCH_ASSOC);
			$nome_usuario = $linha['nome'];
			$tipo_cargo = $linha['cargo'];

			// Se o for um gerente
			if ($tipo_cargo == "Gerente") {
				echo "O gerente {$nome_usuario} não pode ser excluído do sistema, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_delete_funcionario.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Se o for um Administrador
			if ($tipo_cargo == "Administrador") {
				echo "O administrador {$nome_usuario} não pode ser excluído, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_delete_funcionario.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}

			// Query que verifica se o funcionário fez alguma venda
			$procurar_key = "SELECT COUNT(cd_venda) AS countFuncionario FROM venda WHERE cd_funcionario = :cd_funcionario";
			$busca_key = $conexao->prepare($procurar_key);
			$busca_key->bindValue(':cd_funcionario',$cd_funcionario);
			$busca_key->execute();
			$linha2 = $busca_key->fetch(PDO::FETCH_ASSOC);
			$countFuncionario = $linha2['countFuncionario'];
 
			if ($countFuncionario > 0) {
				$pluralSingular = $countFuncionario == 1 ? "uma venda" : "$countFuncionario vendas";
				echo "{$nome_usuario} não pode ser excluído, pois ele realizou $pluralSingular no sistema.";
				echo '<p><a href="../form_crud/form_delete_funcionario.php" title="Refazer operação">
				<button>Refazer operação</button></a></p>';
				exit;
			}
			
			// Se a remocao for possivel de realizar
			try {
			    // Query que faz a remocao
			    $remove = "DELETE FROM funcionario WHERE cd_funcionario = :cd_funcionario";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
			    $remocao->bindValue(':cd_funcionario', $cd_funcionario);
			    // Executa a operacao
			    $remocao->execute();
			    // Se o funcionario for um gerente ou Administrador
				if (($_SESSION['cargo_usuario'] == "Gerente") || ($_SESSION['cargo_usuario'] == "Administrador")) {
					header('Location: ../form_crud/form_select_funcionario.php');
					exit;
				} elseif ($_SESSION['cargo_usuario'] == "Atendente") {
            		session_destroy();
					echo "<script> alert('{$nome_usuario}, você acabou de se excluir. Procure o gerente ou administrador do sistema.'); location.href='/web/index.php' </script>";
					exit;
				}
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
			echo '<p><a href="../form_crud/form_delete_funcionario.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 	
	?>
</body>
</html>