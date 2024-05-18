
<?php

    include_once "./connections/connection.php";

        // Query para obter os dados do filme
        $query = "SELECT filmes.id_filmes, titulo, generos.tipo, capa, ano, sinopse, url_imdb, url_trailer
                  FROM filmes 
                  INNER JOIN generos ON filmes.ref_generos = generos.id_generos
                  WHERE id_filmes = ?";


        if(isset($_GET['id'])) {

            $id_filme = $_GET['id'];

            $link = new_db_connection();

            $stmt = mysqli_stmt_init($link);

            if(mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, "i", $id_filme);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $id_filme, $titulo, $genero, $capa, $ano, $sinopse, $url_imdb, $url_trailer);
                mysqli_stmt_store_result($stmt);

                // Verificar se o filme foi encontrado
                if(mysqli_stmt_num_rows($stmt) > 0) {
                    while(mysqli_stmt_fetch($stmt)) {
                        ?>
                        <section class="sec-filmes pb-5" id="lista-filmes">
                            <div class="container px-lg-5 pt-3">

                                <?php
                                        // Verifica se a variável $_SERVER['HTTP_REFERER'] está definida e não vazia
                                        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                                            // Obtém a URL da página anterior
                                            $previousPage = $_SERVER['HTTP_REFERER'];
                                        } else {
                                            // Se não estiver definida ou vazia, define a URL de uma página padrão
                                            $previousPage = "filmes.php";
                                        }
                                ?>

                                <a class="btn btn-info mt-4" href="<?=$previousPage?>">Voltar</a>
                                <?php
                                    if(isset($_SESSION['ref_perfis']) && $_SESSION['ref_perfis'] == 1) {
                                        echo '<a class="btn btn-danger mt-4" href="update_filme.php?id=' . $id_filme . '">Editar</a>';
                                    }
                                ?>
                                <h1 class="pt-5 pb-3"><?= $titulo ?></h1>
                                <div class="row d-flex flex-row justify-content-between">
                                    <div class="col detalhes">
                                        <img class="img-fluid mb-3" src="./imgs/capas/<?= $capa ?>" />
                                    </div>
                                    <div class="col detalhes">
                                        <h4 class="text-primary"><span class="text-black-50"><?= $ano ?></span> | <?= $genero ?></h4>
                                        <div class="card pb-2 mt-4 shadow rounded">
                                            <div class="card-body">
                                                <h4 class="text-uppercase text-primary m-0 mt-2">Sinopse</h4>
                                                <hr class="my-3 mx-auto" />
                                                <p class="tipo-filme mb-0"><?= $sinopse ?></p>
                                            </div>
                                        </div>
                                        <a class="d-block btn btn-primary mt-4" href="<?= $url_trailer ?>" target="_blank">Trailer</a>
                                        <a class="d-block btn btn-outline-primary mt-4" href="<?= $url_imdb ?>" target="_blank">IMDb</a>

                                        <?php
                                            if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
                                                        // Verificar se o filme está marcado como favorito para o usuário atual
                                                        $query_favorite = "SELECT * FROM filmes_favoritos WHERE ref_utilizadores = ? AND ref_filmes = ?";
                                                        $stmt_favorite = mysqli_stmt_init($link);
                                                        if(mysqli_stmt_prepare($stmt_favorite, $query_favorite)) {
                                                            mysqli_stmt_bind_param($stmt_favorite, "ii", $_SESSION['id'], $id_filme);
                                                            mysqli_stmt_execute($stmt_favorite);
                                                            mysqli_stmt_store_result($stmt_favorite);
                                                            $is_favorite = mysqli_stmt_num_rows($stmt_favorite) > 0;

                                                            if($is_favorite) {
                                                                echo '<a class="d-block btn btn-outline-info mt-4" href="scripts/sc_delete_favorito.php?id_filme=' . $id_filme . '">Remover favorito</a>';
                                                            } else {
                                                                echo '<a class="d-block btn btn-outline-info mt-4" href="scripts/sc_add_favorito.php?id_filme=' . $id_filme . '">Adicionar favorito</a>';
                                                            }
                                                            mysqli_stmt_close($stmt_favorite);
                                                        }
                                            } else {
                                                echo "<p class='mt-3'>Necessário fazer <strong>login</strong> para adicionar aos favoritos</p>";
                                            }

                                        ?>


                                    </div>

                                    <h2>Comentários</h2>
                                    <!-- Exibir comentários do filme -->
                                    <?php
                                    $query_comentarios = "SELECT comentarios.id_comentarios, comentarios.comentario, comentarios.data_insercao, comentarios.ref_filmes , utilizadores.nome FROM comentarios 
                                                                                    INNER JOIN utilizadores ON ref_utilizadores = id_utilizadores
                                                                                    WHERE ref_filmes = ?";
                                    $stmt_comentarios = mysqli_stmt_init($link);

                                    if(mysqli_stmt_prepare($stmt_comentarios, $query_comentarios)) {
                                        mysqli_stmt_bind_param($stmt_comentarios, "i", $id_filme);
                                        mysqli_stmt_execute($stmt_comentarios);
                                        mysqli_stmt_bind_result($stmt_comentarios, $id_comentario, $comentario, $data_criacao, $id_filme, $id_utilizador);
                                        mysqli_stmt_store_result($stmt_comentarios);

                                        if(mysqli_stmt_num_rows($stmt_comentarios) > 0) {
                                            while(mysqli_stmt_fetch($stmt_comentarios)) {
                                                ?>
                                                    <div class='card-body'>
                                                        <h4 class='text-uppercase text-primary m-0 mt-2'><?= $id_utilizador ?></h4>
                                                        <hr class='my-3 mx-auto'>
                                                        <p class='tipo-filme mb-0'><?= $comentario ?></p>
                                                    </div>
                                                <?php
                                            }
                                        } else {
                                            echo "<p>Ainda não há comentários para este filme.</p>";
                                        }
                                        mysqli_stmt_close($stmt_comentarios);
                                    }


                                    if(isset($_SESSION['login']) && $_SESSION['login'] === true){
                                        ?>
                                            <form action="./scripts/sc_adicionar_comentario.php?id_filme=<?= $id_filme ?>" method="post">
                                                    <div class="mb-3 mt-3">
                                                        <label for="uname" class="form-label">Adicionar um comentário:</label>
                                                        <input type="text" class="form-control" id="comentario" placeholder="Introduzir o comentário" name="comentario" required="">
                                                        <div class="valid-feedback">Valid.</div>
                                                        <div class="invalid-feedback">Please fill out this field.</div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Adicionar</button>
                                            </form>
                                        <?php
                                    }else{
                                        ?>
                                            <p>Faça login para adicionar um comentário.</p>
                                        <?php
                                    }
                                        ?>

                                </div>
                            </div>
                        </section>


                        <?php
                    }
                } else {
                    echo '<div class="alert-warning p-4">O filme que procura não existe!</div>';
                }

                mysqli_stmt_close($stmt);

            } else {
                echo "Erro na preparação da declaração";
            }

            mysqli_close($link);

        } else {
            header("Location: filmes.php");
        }

?>
