// JS para formatar as m�scaras nos campos
$(document).ready(function(){
	$("#codigo").mask("0-000000-000000")
	$("#valor_compra").mask("00000.00", {reverse: true})
})