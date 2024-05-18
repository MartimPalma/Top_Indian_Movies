<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="index.php">Top Indian Movies</a>

        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">

            <i class="fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="filmes.php">Filmes</a></li>
                <?php
                session_start(); // Inicia a sessão

                // Verifica se a chave 'ref_perfis' está definida na sessão e se é igual a 1
                if (isset($_SESSION['ref_perfis']) && $_SESSION['ref_perfis'] == 1) {
                    // Se a chave 'ref_perfis' está definida e é igual a 1, exibe o link
                    echo '<li class="nav-item"><a class="nav-link" href="add_filme.php">Inserir filme</a></li>';
                }

                ?>
                <li class="nav-item"><a class="nav-link" href="generos.php">Géneros</a></li>
                <?php

                    // Verifica se a sessão de login está definida e se o utilizador está logado
                    if (isset($_SESSION['login'] , $_SESSION['user']) && $_SESSION['login'] == true) {
                        // Se existe uma sessão iniciada, exibe o nome e o  logout
                        echo '<li class="nav-item"><a class="nav-link" href="logout.php">
                                    <svg class="svg-inline--fa fa-user" aria-hidden="true" focusable="false" data-prefix="far" data-icon="user" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                        <path fill="currentColor" d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z"></path>    
                                    </svg> 
                                '. $_SESSION['user'] . '</a></li>';
                    } else {
                        // Se não existe uma sessão , exibe o link para fazer login
                        echo '<li class="nav-item"><a class="nav-link" href="login.php"><i class="fa-regular fa-user"></i> Entrar</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>