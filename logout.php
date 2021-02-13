<?php
    session_start(); // Comando para fazer com que a sessao funcione
    session_unset(); // Remove as variaveis da sessao (a sessao ainda existe)
    session_destroy(); // Destroi a sessao 
    echo "<script> alert('Você saiu do sistema! Até uma outra ocasião.'); location.href='index.php' </script>"; 
?>