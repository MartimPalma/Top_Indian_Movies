<?php
    include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5 mt-1" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_generos.php" ?>

        <!-- Listar filmes -->
        <div class="row justify-content-center">

            <?php

                //verificar se é admin ou não
                if ($_SESSION['ref_perfis'] == 1) {
                    ?>
                    <div class="row">
                        <form class="col-6" action="./scripts/sc_add_genero.php" method="post" class="was-validated">
                            <div class="mb-3 mt-3">
                                <label for="uname" class="form-label">Adicionar um género:</label>
                                <input type="text" class="form-control" id="genero" placeholder="Introduzir o género" name="genero"
                                       required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                    <?php
                }

            ?>

        </div>
    </div>
</section>
