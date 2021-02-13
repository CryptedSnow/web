// JS para formatar as máscaras nos campos
$(document).ready(function(){
	$("#codigo").mask("0-000000-000000")
	$("#quantidade").mask("0000")
	$("#valor_compra").mask("00000.00", {reverse: true})
})