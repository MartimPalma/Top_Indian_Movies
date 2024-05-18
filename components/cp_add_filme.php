<?php
   include_once "./connections/connection.php";
?>


<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php

        include_once "./components/cp_intro_add_filme.php" ?>

        <!-- Listar filmes -->
        <div class="row justify-content-center">
            <form class="col-6" action="./scripts/filmes/sc_add_filme.php" method="post" class="was-validated">
                <div class="mb-3 mt-3">
                    <label for="titulo" class="form-label">Título:*</label>
                    <input type="text" class="form-control" id="titulo" value="" name="titulo" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="sinopse" class="form-label">Sinopse:*</label>
                    <textarea class="form-control" id="sinopse" value="" name="sinopse" rows="5" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="ano" class="form-label">Ano:*</label>
                    <input type="number" class="form-control" id="ano" value="" name="ano" min="1900" max="2099" step="1" value="2023" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="genero">Género:*</label>
                    <select class="form-control" id="genero" name="genero" required>
                        <option value="">Seleciona o género</option>
                        <?php
                            $query = "SELECT tipo, id_generos FROM generos";

                            // ligação com a base de dados//
                            $link = new_db_connection();
                            // Iniciar a ligação
                            $stmt = mysqli_stmt_init($link);
                            // Preparar a ligação
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_result($stmt, $tipo , $id_generos);

                            // Executar a ligação
                            mysqli_stmt_execute($stmt);
                            while (mysqli_stmt_fetch($stmt)) {
                                echo '<option value="' . $id_generos . '">' . $tipo . '</option>';
                            }
                        ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="url_imdb" class="form-label">URL IMDB:</label>
                    <input type="url" class="form-control" id="url_imdb" value="" name="url_imdb" >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="url_trailer" class="form-label">URL Trailer:</label>
                    <input type="url" class="form-control" id="url_trailer" value="" name="url_trailer" >
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Insert
                </button>
            </form>
        </div>
    </div>
</section>