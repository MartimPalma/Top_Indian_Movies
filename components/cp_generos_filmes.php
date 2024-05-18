<?php
    include_once "./connections/connection.php";
?>

    <section class="sec-filmes pb-5" id="lista-filmes">
        <div class="container px-lg-5 pt-3">

            <!-- Listar filmes -->
            <div class="row">
                <?php

                include_once "./components/cp_intro_generos_filmes.php";

                // verifica se o parâmetro 'id' não está definido na URL
                if (!isset($_GET['id'])) {
                    // se o parâmetro 'id' não estiver definido, redirecionar para página filmes.php
                    header("Location: filmes.php");
                } else {
                    $id_generos = $_GET['id'];
                    //query para obter os dados
                    $query = "SELECT id_generos , tipo , filmes.titulo, filmes.capa, filmes.id_filmes FROM generos
                            INNER JOIN  filmes ON generos.id_generos = filmes.ref_generos 
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
                    mysqli_stmt_bind_result($stmt,$id_generos, $genero, $titulo, $capa ,$id_filmes);

                    //guarda resultados
                    mysqli_stmt_store_result($stmt);


                        // Verificar se o filme existe
                        if (mysqli_stmt_num_rows($stmt) > 0) {
                            // Executa o loop para mostrar os dados do filme
                            while (mysqli_stmt_fetch($stmt)) {
                                ?>

                                    <!--listagem dos filmes por genero-->
                                    <div class='col-md-4 mb-md-0 pb-5'>
                                        <div class='card pb-2 h-100 shadow rounded'>
                                            <div class='capas-preview' style='background-image: url("./imgs/capas/<?= $capa ?>")'></div>
                                            <div class='card-body text-center'>
                                                <h4 class='text-uppercase m-0 mt-2'><?= $titulo ?></h4>
                                                <hr class='my-3 mx-auto'/>
                                                <div class='tipo-filme mb-0 small text-black-50'><?= $genero ?></div>
                                                <a href='filme_detail.php?id=<?= $id_filmes ?>' class='mt-2 btn btn-outline-primary'>
                                                    <b>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                        </svg>
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

                                    <div class="alert-warning p-4">Ainda não existem filmes associados ao género que procura!</div>
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

