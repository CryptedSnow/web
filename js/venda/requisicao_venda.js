// JS que faz a requisição de dados
function buscaDados(){
    // Variavel cd_venda que retorna o elemento cd_venda
    var cd_venda = document.querySelector("#cd_venda").value;
    // Verifica se o option selecionado e vazio (value="")
    if(!cd_venda){
    	// Apaga os valores dos elementos do formulario
      	document.forms[0].reset();
      	// Aborta o resto da funcao 
      	return;
   	}
    // Instancia a classe XMLHttpReques
    ajax = new XMLHttpRequest();
    // Especifica o Method e a url que sera chamada
    ajax.open("GET","/web/json/id_venda.php?cd_venda="+cd_venda,true);
    // Executa na resposta do ajax
    ajax.onreadystatechange = function(){
        // Se completar a requisicao
    	if(ajax.readyState == 4){
    	    // Se retornar
    	    if(ajax.status == 200){
        		// Converte a string retornada para dados em JSON no JS
        		var retornoJson = JSON.parse(ajax.responseText);
        		// Preenche os campos com o retorno dos dados em cada campo
        		document.querySelector("#cd_produto").value = retornoJson[0].cd_produto;
        		document.querySelector("#cd_funcionario").value = retornoJson[0].cd_funcionario;
        		document.querySelector("#cd_cliente").value = retornoJson[0].cd_cliente;
        		document.querySelector("#valor_item").value = retornoJson[0].valor_item;
        		document.querySelector("#quantidade").value = retornoJson[0].quantidade;
    		}
	    }
    }
    // Envia a solicitacao
    ajax.send();
}