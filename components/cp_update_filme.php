<?php
    include_once "./connections/connection.php";

    if(isset($_GET['id'])) {
        $id_filme = $_GET['id'];

        // Conectar ao banco de dados
        $link = new_db_connection();

        // Consultar os dados do filme a ser editado
        $query = "SELECT titulo, ref_generos, ano, sinopse, url_imdb, url_trailer FROM filmes WHERE id_filmes = ?";
        $stmt = mysqli_stmt_init($link);
        if(mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_filme);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $titulo, $genero, $ano, $sinopse, $url_imdb, $url_trailer);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            // Consultar os gêneros disponíveis
            $query_generos = "SELECT id_generos, tipo FROM generos";
            $stmt_generos = mysqli_prepare($link, $query_generos);
            mysqli_stmt_execute($stmt_generos);
            mysqli_stmt_bind_result($stmt_generos, $id_genero, $tipo_genero);

            ?>
            <!-- Seção de edição de filme -->
            <section class="sec-filmes pb-5" id="lista-filmes">
                <div class="container px-lg-5 pt-3">
                    <div class="row justify-content-center">

                    <h1 class="pt-5 pb-3">Editar Filme</h1>
                    <form class="col-6" action="./scripts/filmes/sc_update_filme.php?id_filme=<?= $id_filme ?>" method="post" class="was-validated">
                        <div class="mb-3 mt-3">
                            <label for="titulo" class="form-label">Título:*</label>
                            <input type="text" class="form-control" id="titulo" value="<?= $titulo ?>" name="titulo" required>
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="sinopse" class="form-label">Sinopse:*</label>
                            <textarea class="form-control" id="sinopse" name="sinopse" rows="5" required><?= $sinopse ?></textarea>
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="ano" class="form-label">Ano:*</label>
                            <input type="number" class="form-control" id="ano" value="<?= $ano ?>" name="ano" min="1900" max="2099" step="1" required>
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo.</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="genero" class="form-label">Género:</label>
                            <select class="form-select" id="genero" name="genero" required>
                                <option value="">Escolha um género</option>
                                <?php
                                    // Preencher as opções do menu suspenso com os gêneros disponíveis
                                    while(mysqli_stmt_fetch($stmt_generos)) {
                                        echo '<option value="' . $id_genero . '"';
                                        if($genero == $id_genero) {
                                            echo ' selected';
                                        }
                                        echo '>' . $tipo_genero . '</option>';
                                    }
                                    mysqli_stmt_close($stmt_generos);
                                ?>
                            </select>
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, selecione uma opção.</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="url_imdb" class="form-label">URL IMDB:</label>
                            <input type="url" class="form-control" id="url_imdb" value="<?= $url_imdb ?>" name="url_imdb">
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo com uma URL válida.</div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="url_trailer" class="form-label">URL Trailer:</label>
                            <input type="url" class="form-control" id="url_trailer" value="<?= $url_trailer ?>" name="url_trailer">
                            <div class="valid-feedback">Válido.</div>
                            <div class="invalid-feedback">Por favor, preencha este campo com uma URL válida.</div>
                        </div>
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </form>
                    </div>
                </div>
            </section>
            <?php
            // Incluir o rodapé da página
            include_once "components/cp_footer.php";
            mysqli_close($link);
        }
    }


