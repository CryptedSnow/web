// JS para formatar as máscaras nos campos
$(document).ready(function() {
	$("#quantidade").mask("0000")
	$("#valor_item").mask("00000.00", {reverse: true})
})