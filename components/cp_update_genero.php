<?php
    include_once "./connections/connection.php";

        if ($_SESSION['ref_perfis'] == 1) {
            ?>
            <section class="sec-filmes pb-5" id="lista-filmes">
                <div class="container px-lg-5 pt-3">
            <!-- Intro -->
            <?php include_once "./components/cp_intro_update_genero.php" ?>

            <!-- Listar filmes -->
                    <div class="row justify-content-center">


                        <?php
                        // Verifica se foi passado um ID na query string
                        if(isset($_GET['id'])) {
                            // Obtém o ID do género a ser editado
                            $id_genero = $_GET['id'];

                            // Query para obter os dados do género
                            $query = "SELECT tipo FROM generos WHERE id_generos = ?";

                            $link = new_db_connection();
                            $stmt = mysqli_stmt_init($link);

                            if (mysqli_stmt_prepare($stmt, $query)) {
                                mysqli_stmt_bind_param($stmt, "i", $id_genero);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $tipo_genero);
                                mysqli_stmt_fetch($stmt);
                                if (isset($tipo_genero)) {
                                    ?>
                                    <div class="row">
                                        <form class="col-6" action="./scripts/sc_update_genero.php?id=<?= $id_genero ?>" method="post" class="was-validated">
                                            <div class="mb-3 mt-3">
                                                <label for="uname" class="form-label">Atualizar um género:</label>
                                                <input type="text" class="form-control" id="genero" placeholder="Introduzir o género" name="genero"
                                                       value="<?= $tipo_genero ?>" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Atualizar</button>
                                        </form>
                                    </div>
                    </div>
                </div>
            </section>
                        <?php
                        mysqli_stmt_close($stmt);

                    } else {
                        // Caso não seja possível obter os dados do género
                        echo "Erro ao obter dados do género.";
                    }
                }

            }
        } else {
            echo "Apenas administradores podem acessar esta página.";
        }

?>








