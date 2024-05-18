<?php

    include_once "../../connections/connection.php";

        if (isset($_GET['id_filme'], $_POST['titulo'], $_POST['sinopse'], $_POST['ano'], $_POST['genero'])) {

            $id_filme = $_GET['id_filme'];
            $titulo = $_POST['titulo'];
            $sinopse = $_POST['sinopse'];
            $ano = $_POST['ano'];
            $genero = $_POST['genero'];

            $url_imdb = isset($_POST['url_imdb']) ? $_POST['url_imdb'] : null;
            /*
                if(isset($_POST['url_imdb'])) {
                    $url_imdb = $_POST['url_imdb'];
                } else {
                    $url_imdb = null;
                }
            */
            $url_trailer = isset($_POST['url_trailer']) ? $_POST['url_trailer'] : null;

            $link = new_db_connection();

            $query = "UPDATE filmes SET titulo = ?, ref_generos = ?, ano = ?, sinopse = ?, url_imdb = ?, url_trailer = ? WHERE id_filmes = ?";
            $stmt = mysqli_stmt_init($link);
            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, "siisssi", $titulo, $genero, $ano, $sinopse, $url_imdb, $url_trailer, $id_filme);

                if (mysqli_stmt_execute($stmt)) {
                    header("Location:../../filme_detail.php?id=".$id_filme);
                    exit();
                } else {
                    echo "Erro ao atualizar o filme. Por favor, tente novamente.";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "Erro na preparação da declaração SQL. Por favor, tente novamente.";
            }

            mysqli_close($link);
        } else {
            echo "Todos os campos são obrigatórios. Por favor, preencha todos os campos e tente novamente.";
        }


