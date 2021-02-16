<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> DELETE | FUNCIONÁRIO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Arquivo conexao.php
		require_once '../conexao/conexao.php'; 
		// Se existir o botao de Deletar
		if(isset($_POST['Deletar'])){
			// Especifica a variavel
			$cd_funcionario = $_POST['cd_funcionario'];

			// Vai buscar o nome e cargo de gerente pela chave do funcionario
			$procurar_cargo = "SELECT nome, cargo FROM funcionario WHERE cd_funcionario = :cd_funcionario";
			$busca_cargo = $conexao->prepare($procurar_cargo);
			$busca_cargo->bindValue(':cd_funcionario',$cd_funcionario);
			$busca_cargo->execute();
			$linha = $busca_cargo->fetch(PDO::FETCH_ASSOC);
			$nome_usuario = $linha['nome'];
			$tipo_cargo = $linha['cargo'];

			// Se o funcionário for um gerente
			if ($tipo_cargo == "Gerente") {
				echo "O gerente {$nome_usuario} não pode ser excluído do sistema por ele ser um gerente, refaça novamente a operação.";
				echo '<p><a href="../form_crud/form_delete_funcionario.php" 
				title="Refazer a operação"><button>Refazer operação</button></a></p>';
				exit;
			}
			
			// Se a remocao for possivel de realizar
			try {
			    // Query que faz a remocao
			    $remove = "DELETE FROM funcionario WHERE cd_funcionario = :cd_funcionario";
			    // $remocao recebe $conexao que prepare a operacao de exclusao
			    $remocao = $conexao->prepare($remove);
			    // Vincula um valor a um parametro
			    $remocao->bindValue(':cd_funcionario',$cd_funcionario);
			    // Executa a operacao
			    $remocao->execute();
			    // Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_funcionario.php');
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