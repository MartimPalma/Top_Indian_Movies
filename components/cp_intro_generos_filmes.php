<?php
    include_once "./connections/connection.php";

            if (!isset($_GET['id'])) {

                include_once "./components/cp_intro_generos.php";

            } else {
                    $id_generos = $_GET['id'];
                    //query para obter os dados
                    $query = "SELECT tipo FROM generos
                            WHERE id_generos = ?";

                    // ligação com a base de dados//
                    $link = new_db_connection();

                    // Iniciar a ligação
                    $stmt = mysqli_stmt_init($link);

                    // Preparar a ligação
                    mysqli_stmt_prepare($stmt,$query);
                    mysqli_stmt_bind_param($stmt,"i",$id_generos);

                    // Executar a ligação
                    mysqli_stmt_execute($stmt);

                    //atribuição dos dados a variáveis
                    mysqli_stmt_bind_result($stmt,$tipo);

                    //guarda resultados
                    mysqli_stmt_store_result($stmt);

                            while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                <h1>Todos os filmes de <?=$tipo?></h1>
                                <p class="text-black-60 text-left pb-4">
                                    Aqui encontras os melhores filmes de <strong><?=$tipo?></strong> indianos.
                                </p>
                                <?php
                            }
            }

?>
