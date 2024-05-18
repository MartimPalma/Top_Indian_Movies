<?php
    include_once "../connections/connection.php";

    if (isset($_GET['id'])) {
        // Obter o ID do género a ser excluído passado na querystring
        $id_genero = $_GET['id'];

        // Verificar se há filmes associados ao género
        $query_verificar_filmes = "SELECT COUNT(ref_generos) FROM filmes 
                                   INNER JOIN generos ON filmes.ref_generos = generos.id_generos
                                   WHERE id_generos = ?" ;

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query_verificar_filmes)) {

            mysqli_stmt_bind_param($stmt, 'i', $id_genero);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $num_filmes);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // Verificar se houver filmes associados ao género
            if ($num_filmes > 0) {
                ?>
                <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="utf-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
                        <meta name="description" content="" />
                        <meta name="author" content="" />
                        <title>Top indian movies</title>
                        <link rel="icon" type="image/x-icon" href="imgs/favicon.ico" />
                        <!-- Font Awesome icons (free version)-->
                        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
                        <!-- Google fonts-->
                        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
                        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
                        <!-- Core theme CSS (includes Bootstrap)-->
                        <link href="../css/styles.css" rel="stylesheet" />
                    </head>
                    <body id="page-top">

                        <!-- Navigation-->
                        <?php include_once "../components/cp_navbar.php" ?>

                            <section class="sec-filmes pb-5" id="lista-filmes">
                                <div class="container px-lg-5 pt-3">
                                    <div class="row">
                                        <div class="alert-warning p-4">Não é possível excluir este género porque existem filmes associados a ele.</div>
                                        <a class="btn btn-info mt-4" href="../generos.php">Voltar</a>
                                    </div>
                                </div>
                            </section>

                        <!-- Rodapé -->
                        <?php include_once "../components/cp_footer.php" ?>

                <?php
            } else {
                // Se não houver filmes associados, excluir o género da base de dados
                $query_excluir_genero = "DELETE FROM generos WHERE id_generos = ?";
                $stmt = mysqli_stmt_init($link);

                if (mysqli_stmt_prepare($stmt, $query_excluir_genero)) {
                    mysqli_stmt_bind_param($stmt, 'i', $id_genero);

                    if (mysqli_stmt_execute($stmt)) {
                        // Exclusão bem-sucedida, redirecionar para a página dos géneros
                        header("Location: ../generos.php");
                    } else {
                        echo "Erro ao excluir o género.";
                    }
                } else {
                    echo "Erro ao preparar a exclusão do género.";
                }

                mysqli_stmt_close($stmt);
            }
        } else {
            echo "Erro ao verificar a existência de filmes associados ao género.";
        }
    } else {
        header("Location: ../generos.php");
    }
?>
