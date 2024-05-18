<?php
    include_once "../connections/connection.php";

    session_start();

    if(isset($_SESSION['login']) && $_SESSION['login'] === true){

        if (isset($_POST['comentario'])) {

                $id_filme = $_GET['id_filme'];
                $comentario = ($_POST['comentario']);

                $link = new_db_connection();

                $query = "INSERT INTO comentarios (comentario, ref_filmes, ref_utilizadores) VALUES (?, ?, ?)";

                $stmt = mysqli_stmt_init($link);
                if (mysqli_stmt_prepare($stmt, $query)) {

                     mysqli_stmt_bind_param($stmt, "sii", $comentario, $id_filme, $_SESSION['id']);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "Comentário adicionado com sucesso.";
                    } else {
                        echo "Erro ao adicionar comentário.";
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Erro na preparação da declaração.";
                }
                mysqli_close($link);
        } else {
            echo "Por favor, preencha todos os campos do formulário.";
        }
    } else {
        echo "Precisa estar logado para adicionar um comentário.";
    }

?>

