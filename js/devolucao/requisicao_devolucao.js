// JS que faz a requisicao de dados
function buscaDados() {
	// Variavel cd_devolucao que retorna o elemento cd_devolucao
	var cd_devolucao = document.querySelector("#cd_devolucao").value;
	// Verifica se o option selecionado e vazio (value="")
	if (!cd_devolucao) {
		// Apaga os valores dos elementos do formulario
		document.forms[0].reset();
		// Aborta o resto da funcao 
		return;
	}
	// Instancia a classe XMLHttpReques
	ajax = new XMLHttpRequest();
	// Especifica o Method e a url que sera chamada
	ajax.open("GET", "/web/json/id_devolucao.php?cd_devolucao=" + cd_devolucao, true);
	// Executa na resposta do ajax
	ajax.onreadystatechange = function() {
		// Se completar a requisicao
		if (ajax.readyState == 4) {
			// Se retornar
			if(ajax.status == 200){
        		// Converte a string retornada para dados em JSON no JS
        		var retornoJson = JSON.parse(ajax.responseText);
        		// Preenche os campos com o retorno dos dados em cada campo
        		document.querySelector("#cd_venda").value = retornoJson[0].cd_venda;
        		document.querySelector("#cd_produto").value = retornoJson[0].cd_produto;
        		document.querySelector("#valor_item").value = retornoJson[0].valor_item;
        		document.querySelector("#quantidade").value = retornoJson[0].quantidade;
		        document.querySelector("#motivo_devolucao").value = retornoJson[0].motivo_devolucao;
    		}
		}
	}
	// Envia a solicitacao
	ajax.send();
}