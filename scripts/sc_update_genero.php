<?php
    include_once "../connections/connection.php";
        // Verificar se o ID do género está definido na query string
        if (isset($_GET['id']) && isset($_POST['genero'])) {
            // Obter o ID do género da query string
            $id_genero = $_GET['id'];

            // Obter o nome atualizado do género do $_POST
            $tipo_genero = $_POST['genero'];

            // Query para atualizar o nome do género na base de dados
            $query = "UPDATE generos SET tipo = ? WHERE id_generos = ?";

            // Conectar-se ao banco de dados
            $link = new_db_connection();

            // Iniciar a preparação da declaração
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $query)) {
                // Vincular os parâmetros
                mysqli_stmt_bind_param($stmt, "si", $tipo_genero, $id_genero);

                // Executar a declaração
                mysqli_stmt_execute($stmt);

                // Fechar a declaração
                mysqli_stmt_close($stmt);
            }

            // Redirecionar de volta para a página generos.php
            header("Location: ../generos.php");

        } else {
            // Caso o ID do género ou o nome do género não estejam definidos, redirecionar para uma página de erro ou exibir uma mensagem de erro
            echo "Erro: ID do género ou nome do género não definidos.";
        }
?>
