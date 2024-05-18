
<?php
    include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_filmes.php" ?>

        <!-- Listar filmes -->
        <div class="row">
        <?php

            if (!isset($_POST['pesquisa'])) {
                $query = "SELECT filmes.id_filmes,titulo,generos.tipo,capa  FROM filmes 
                INNER JOIN  generos ON filmes.ref_generos = generos.id_generos
                ORDER BY titulo ASC";
            // ligação com a base de dados//
            $link = new_db_connection();
            // Iniciar a ligação
            $stmt = mysqli_stmt_init($link);
            // Preparar a ligação
            mysqli_stmt_prepare($stmt,$query);
            // Executar a ligação
            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt,$id_filmes, $titulo, $genero , $capa);

            while (mysqli_stmt_fetch($stmt)) {
            ?>

                <div class='col-md-4 mb-md-0 pb-5'>
                    <div class='card pb-2 h-100 shadow rounded'>
                        <div class='capas-preview' style='background-image: url("./imgs/capas/<?= $capa ?>")'></div>
                        <div class='card-body text-center'>
                            <h4 class='text-uppercase m-0 mt-2'><?= $titulo ?></h4>
                            <hr class='my-3 mx-auto'/>
                            <div class='tipo-filme mb-0 small text-black-50'><?= $genero ?></div>
                            <a href='filme_detail.php?id=<?= $id_filmes ?>' class='mt-2 btn btn-outline-primary'>
                                <b><i class='fas fa-plus text-primary'></i></b>
                            </a>
                        </div>
                    </div>
                </div>

            <?php
            }            // Fechar ligação
            mysqli_stmt_close($stmt);

            } else{
                $pesquisa = $_POST['pesquisa'];
                //query para obter os dados
                $query = "SELECT id_filmes,titulo, generos.tipo, capa, ano FROM filmes
                INNER JOIN generos ON generos.id_generos = filmes.ref_generos                     
                WHERE titulo LIKE CONCAT('%',?,'%') OR ano LIKE CONCAT('%',?,'%')";
                // ligação com a base de dados//
                $link = new_db_connection();
                // Iniciar a ligação
                $stmt = mysqli_stmt_init($link);
                // Preparar a ligação
                mysqli_stmt_prepare($stmt,$query);
                mysqli_stmt_bind_param($stmt, "ss", $pesquisa, $pesquisa);


                // Executar a ligação
                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt,$id_filmes, $titulo, $genero , $capa, $ano);

                mysqli_stmt_store_result($stmt);
                // Verificar se existe
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    // Executa o loop para mostrar os dados do filme
                    while (mysqli_stmt_fetch($stmt)) {
                        ?>
                        <div class='col-md-4 mb-md-0 pb-5'>
                            <div class='card pb-2 h-100 shadow rounded'>
                                <div class='capas-preview' style='background-image: url("./imgs/capas/<?= $capa ?>")'></div>
                                <div class='card-body text-center'>
                                    <h4 class='text-uppercase m-0 mt-2'><?= $titulo ?></h4>
                                    <hr class='my-3 mx-auto'/>
                                    <div class='tipo-filme mb-0 small text-black-50'><?= $genero ?></div>
                                    <a href='filme_detail.php?id=<?= $id_filmes ?>' class='mt-2 btn btn-outline-primary'>
                                        <b>
                                            <i class='fas fa-plus text-primary'></i>
                                        </b>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }else{

                    // Verifica se a variável $_SERVER['HTTP_REFERER'] está definida e não vazia
                    if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                        // Obtém a URL da página anterior
                        $previousPage = $_SERVER['HTTP_REFERER'];
                    } else {
                        // Se não estiver definida ou vazia, define a URL de uma página padrão
                        $previousPage = "filmes.php";
                    }
                    ?>

                    <div class="alert-warning p-4">Nenhum filme corresponde à sua pesquisa!</div>
                    <a class="btn btn-info mt-4" href="<?=$previousPage?>">Voltar</a>

                    <?php
                }
                // Fechar ligação
                mysqli_stmt_close($stmt);
            }
            ?>

        </div>
    </div>
</section>