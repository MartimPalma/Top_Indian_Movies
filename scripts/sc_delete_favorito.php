<?php
    include_once "../connections/connection.php";

    // Verifica se o ID do filme foi passado por GET
    if(isset($_GET['id_filme'])) {

        $id_filme = $_GET['id_filme'];

        // Iniciar a sessão
        session_start();

        if($_SESSION['login'] === true) {
            // Conectar ao banco de dados
            $link = new_db_connection();

            // Query para inserir o filme favorito na tabela filmes_favoritos
            $query = "DELETE FROM filmes_favoritos WHERE ref_utilizadores = ? AND ref_filmes = ?";

            // Preparar e executar a declaração
            if($stmt = mysqli_prepare($link, $query)) {
                // Ligação dos parâmetros
                mysqli_stmt_bind_param($stmt, "ii", $_SESSION['id'], $id_filme);

                if(mysqli_stmt_execute($stmt)) {
                    // Filme removido aos favoritos com sucesso
                    echo "Filme removido aos favoritos com sucesso!";

                    header("Location: ../filme_detail.php?id=".$id_filme);

                } else {
                    // Erro ao remover filme aos favoritos
                    echo "Erro ao remover filme aos favoritos";
                }

                // Fechar declaração
                mysqli_stmt_close($stmt);

            } else {
                // Erro na preparação da declaração
                echo "Erro na preparação da declaração";
            }

            // Fechar conexão
            mysqli_close($link);
        } else {
            // O usuário não está autenticado
            echo "Necessário fazer login para adicionar aos favoritos";
        }
    } else {
        // ID do filme não foi passado por GET
        echo "ID do filme não fornecido";
    }
?>
