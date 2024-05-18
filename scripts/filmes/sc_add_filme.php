<?php
    include_once "../../connections/connection.php";

    session_start(); // Inicia a sessão

    $link = new_db_connection();

    // Define a capa padrão para o novo filme
    $capa = "default.png";

    // Verifica se os campos opcionais foram preenchidos ou não
    $url_imdb = !empty($_POST['url_imdb']) ? $_POST['url_imdb'] : null;
        /*if(isset($_POST['url_imdb'])) {
            $url_imdb = $_POST['url_imdb'];
        } else {
            $url_imdb = null;
        }*/
    $trailer = !empty($_POST['url_trailer']) ? $_POST['url_trailer'] : null;

    $query = "INSERT INTO filmes (titulo,sinopse,ano,ref_generos ,capa, url_imdb, url_trailer, ref_utilizadores) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if($stmt = mysqli_prepare($link, $query)) {

        mysqli_stmt_bind_param($stmt, "ssiisssi", $_POST['titulo'], $_POST['sinopse'], $_POST['ano'],$_POST['genero'], $capa, $url_imdb, $trailer,$_SESSION['id']);

        if(mysqli_stmt_execute($stmt)) {
            // Filme adicionado aos favoritos com sucesso
            echo "Filme adicionado aos favoritos com sucesso!";
            header("Location:../../filmes.php");
            exit();
        } else {
            // Erro ao adicionar filme aos favoritos
            echo "Erro ao adicionar filme aos favoritos";
        }

        // Fecha a declaração
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a declaração SQL";
    }

?>

