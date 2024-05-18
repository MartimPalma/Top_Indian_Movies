<?php
    include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_generos.php" ?>

        <!-- Listar filmes -->
        <div class="row justify-content-center">
            <!-- Intro -->

            <?php

            // Verificar se o utilizador está logado
            if (isset($_SESSION['id'])){
                //vai buscar a variavel admin e verifica e é admin ou não
                include_once "./components/cp_add_generos.php";
            }


            // Query para obter os dados
            $query = "SELECT generos.id_generos ,generos.tipo FROM generos";

            // ligação com a base de dados//
            $link = new_db_connection();
            // Iniciar a ligação
            $stmt = mysqli_stmt_init($link);
            // Preparar a ligação
            mysqli_stmt_prepare($stmt,$query);

            mysqli_stmt_execute($stmt);
            //atribuição dos dados a variáveis
            mysqli_stmt_bind_result($stmt,$id_generos , $genero );


            while (mysqli_stmt_fetch($stmt)) {
                ?>
                <div class='col-md-4 mb-md-0 pb-5'>
                    <div class='card pb-2 h-100 shadow rounded'>
                        <div class='card-body text-center'>
                            <div class='tipo-filme mb-0 small text-black-50'><?= $genero ?></div>

                            <a href='generos_filmes.php?id=<?= $id_generos ?>' class='mt-2 btn btn-outline-primary tipo-filme mb-0 small text-black-50'>
                                <b>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </b>
                            </a>
                            <?php
                            //vai buscar a variavel admin do cp_add_generos e verifica se é admin ou não
                            if ( (isset($_SESSION['id'])) && $_SESSION['ref_perfis'] == 1) {
                                ?>
                                <a href='scripts/sc_delete_genero.php?id=<?= $id_generos ?>' class='mt-2 btn btn-outline-danger tipo-filme mb-0 small text-black-50'>
                                    <b>
                                        <i class=' text-primary'>Delete</i>
                                    </b>
                                </a>
                                <a href='update_genero.php?id=<?= $id_generos ?>' class='mt-2 btn btn-outline-secondary tipo-filme mb-0 small text-black-50'>
                                    <b>
                                        Editar
                                    </b>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
            }            // Fechar ligação
            mysqli_stmt_close($stmt);
            ?>

        </div>
    </div>
</section>


