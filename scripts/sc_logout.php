<?php
    // Inicia a sessão
    session_start();
    // Destroi a sessão existente
    session_destroy();

    // Redireciona para a página de login ou qualquer outra página desejada
    header("Location: ../login.php");
?>