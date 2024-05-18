<?php
    include_once "../connections/connection.php";

    // Verificar se o formulário foi enviado e se tem mais que 3 carateres
    if (isset($_POST['genero']) && strlen(trim($_POST["genero"])) >= 3) {

        $genero = $_POST['genero'];

        // Query para inserir um novo género na base de dados
        $query = "INSERT INTO generos (tipo) VALUES (?)";

        // Ligação com a base de dados
        $link = new_db_connection();

        // Iniciar a ligação
        $stmt = mysqli_stmt_init($link);

        // Preparar a ligação
        if (mysqli_stmt_prepare($stmt, $query)) {
            // Vincular os parâmetros
            mysqli_stmt_bind_param($stmt, "s", $genero);

            // Executar a ligação
            if (mysqli_stmt_execute($stmt)) {
                // Género inserido com sucesso
                header("Location: ../generos.php");
            } else {
                // Erro ao inserir o género
                echo "<p>Ocorreu um erro ao inserir o género na base de dados.</p>";
            }
        } else {
            // Erro na preparação da consulta
            echo "<p>Erro na preparação da consulta.</p>";

        }

        // Fechar ligação
        mysqli_stmt_close($stmt);

    }else {
        ?>
            <!-- Ficheiro de CSS tem um caminho diferente , por isso não pode ser incluído cp_header.php -->
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
                                <div class="alert-warning p-4">Insira um género com mais de 3 carateres!</div>
                                <a class="btn btn-info mt-4" href="../generos.php">Voltar</a>
                            </div>
                        </div>
                    </section>

                <!-- Rodapé -->
                <?php include_once "../components/cp_footer.php" ?>
        <?php
    }

?>
