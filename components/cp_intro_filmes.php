<div class="row">
    <h1>Filmes</h1>

    <div class="col-8">
        <p class="text-black-60 text-left pb-4">
            A lista dos melhores filmes indianos está disponível.
            <br />
            Não percas!
        </p>
    </div>

    <!-- Input de pesquisa -->
    <form class="col-4" method="post" action="filmes.php">
        <div class="row">
            <div >
                <label for="pesquisa">Título:</label>
                <input class="form-control" id="pesquisa" name="pesquisa" type="text" placeholder="Insere o título" aria-label="Pesquisa" />
            </div>
        </div>
        <div class="row mt-3 mb-3">
            <div class="col">
                <label for="genero">Género:</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="">Todos</option>
                    <?php
                    $query = "SELECT generos.tipo FROM generos";

                    // ligação com a base de dados//
                    $link = new_db_connection();
                    // Iniciar a ligação
                    $stmt = mysqli_stmt_init($link);
                    // Preparar a ligação
                    mysqli_stmt_prepare($stmt,$query);
                    // Executar a ligação
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $genero );

                    while (mysqli_stmt_fetch($stmt)) {
                        echo '<option value="' . $genero . '">' . $genero . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col">
                <label for="ano">Ano:</label>
                <select class="form-control" id="ano" name="ano">
                    <option value="">Todos</option>
                    <?php
                    $query = "SELECT DISTINCT ano FROM filmes
                                ORDER BY ano DESC";

                    // ligação com a base de dados//
                    $link = new_db_connection();
                    // Iniciar a ligação
                    $stmt = mysqli_stmt_init($link);
                    // Preparar a ligação
                    mysqli_stmt_prepare($stmt,$query);
                    // Executar a ligação
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $ano );

                    while (mysqli_stmt_fetch($stmt)) {
                        echo '<option value="' . $ano . '">' . $ano . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-3  mb-3">
                <input class="form-control btn-primary" type="submit" value="Ir" />
            </div>
        </div>
    </form>


</div>