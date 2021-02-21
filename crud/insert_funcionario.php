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
	<title> INSERT | FUNCIONÁRIO </title>
	<link rel="stylesheet" href="/web/css/css.css">
</head>
<body>
	<?php
		// Se existir o botao de Inserir
		if (isset($_POST['Inserir'])) {
			// Especifica a variavel
			$nome = $_POST['nome'];
			$cpf = $_POST['cpf'];
			$telefone = $_POST['telefone'];
			$email = $_POST['email'];
			$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
			// Se a insercao for possivel de realizar
			try {
				// Query que faz a insercao
				$insercao = "INSERT INTO funcionario (nome,cpf,telefone,email,senha) 
				VALUES (:nome,:cpf,:telefone,:email,:senha)";
				// $insere_dados recebe $conexao que prepare a operacao de insercao
				$insere_dados = $conexao->prepare($insercao);
				// Vincula um valor a um parametro
				$insere_dados->bindValue(':nome', $nome);
				$insere_dados->bindValue(':cpf', $cpf);
				$insere_dados->bindValue(':telefone', $telefone);
				$insere_dados->bindValue(':email', $email);
				$insere_dados->bindValue(':senha', $senha);
				// Executa a operacao
				$insere_dados->execute();
				// Retorna para a pagina de formulario de listagem
				header('Location: ../form_crud/form_select_funcionario.php');
				// Se a insercao nao for possivel de realizar
			} catch (PDOException $falha_insercao) {
				echo "A inserção não foi feita" . $falha_insercao->getMessage();
				die;
			} catch (Exception $falha) {
				echo "Erro não característico do PDO".$falha->getMessage();
				die;
			}
		// Caso nao exista
		} else {
			echo "Ocorreu algum erro ao finalizar a operação, refaça novamente a operação.";
			echo '<p><a href="../form_crud/form_insert_funcionario.php" title="Refazer operação"><button>Refazer operação</button></a></p>';
			exit;
		} 
	?>
</body>
</html>