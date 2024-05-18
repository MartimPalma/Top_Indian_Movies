
<?php
  include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_filmes.php" ?>

                    <!-- Listar filmes -->
                    <div class="row justify-content-center">
                        <?php

                        if ((!isset($_POST['pesquisa']) || !$_POST['pesquisa']) && (!isset($_POST['genero']) || !$_POST['genero']) && (!isset($_POST['ano']) || !$_POST['ano'])) {
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
                            }            // Fechar ligação
                            mysqli_stmt_close($stmt);

                        } else{
                            $contarFiltros = 0;

                            $pesquisa = null;
                            $pesGenero = null;
                            $pesAno = null;

                            if($_POST['pesquisa']){
                                $pesquisa = $_POST['pesquisa'];
                                $contarFiltros++;
                            }

                            if($_POST['genero']){
                                $pesGenero = $_POST['genero'];
                                $contarFiltros++;
                            }

                            if($_POST['ano']){
                                $pesAno = $_POST['ano'];
                                $contarFiltros++;
                            }

                            $nFiltros = $contarFiltros; //para termos uma variavel com o n total de filtros existentes

                            $query = "SELECT id_filmes, titulo, generos.tipo, capa, ano 
                                      FROM filmes
                                      INNER JOIN generos ON generos.id_generos = filmes.ref_generos
                                      WHERE (";

                                if ($pesAno) {
                                    $query = $query . "(ano LIKE CONCAT('%',?,'%') OR ano = ? )";
                                    $contarFiltros--;
                                    if($contarFiltros > 0){
                                        $query = $query . " AND ";
                                    }
                                }

                                // Adicionar condições dos filtros, se forem fornecidos
                                if ($pesGenero) {
                                    $query = $query . "generos.tipo = ?";
                                    $contarFiltros--;
                                    if($contarFiltros > 0){
                                        $query = $query . " AND ";
                                    }
                                }

                                if ($pesquisa) {
                                    $query = $query . "(titulo LIKE CONCAT('%',?,'%'))";
                                    $contarFiltros--;
                                }

                            $query = $query . ")";

                            //var_dump($query);

                            $link = new_db_connection();
                            $stmt = mysqli_stmt_init($link);
                            mysqli_stmt_prepare($stmt, $query);


                            if($nFiltros == 3){
                                mysqli_stmt_bind_param($stmt, "ssss", $pesAno, $pesAno, $pesGenero, $pesquisa);
                            }elseif($nFiltros == 2){
                                if($pesAno){
                                    if($pesGenero){
                                        mysqli_stmt_bind_param($stmt, "sss", $pesAno, $pesAno, $pesGenero);
                                    }else
                                        mysqli_stmt_bind_param($stmt, "sss", $pesAno, $pesAno, $pesquisa);
                                }else{
                                    mysqli_stmt_bind_param($stmt, "ss", $pesGenero,$pesquisa);
                                }
                            }else{
                                if($pesAno){
                                    mysqli_stmt_bind_param($stmt, "ss", $pesAno, $pesAno);
                                }
                                if ($pesGenero) {
                                    mysqli_stmt_bind_param($stmt, "s", $pesGenero);
                                }
                                if ($pesquisa) {
                                    mysqli_stmt_bind_param($stmt, "s", $pesquisa);
                                }
                            }


                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_filmes, $titulo, $genero, $capa, $ano);
                            mysqli_stmt_store_result($stmt);


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
