<?php
    session_start(); // Inicia a sessão

    include_once "../connections/connection.php";

    // Verifica se o utilizador e a password foram introduzidos
    if (isset($_POST['login'], $_POST['password'])) {

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "SELECT id_utilizadores, password_hash, login, ref_perfis FROM utilizadores WHERE login LIKE ?";

        if (mysqli_stmt_prepare($stmt, $query)) {
            $username = $_POST['login'];

            mysqli_stmt_bind_param($stmt, 's' , $username);

            mysqli_stmt_execute($stmt);

            mysqli_stmt_bind_result($stmt, $id, $password_hash, $username, $ref_perfis);

            if (mysqli_stmt_fetch($stmt)) {
                if (password_verify($_POST['password'], $password_hash)) {
                    // Define as variáveis de sessão
                    $_SESSION['id'] = $id;
                    $_SESSION['user'] = $username;
                    $_SESSION['login'] = true; // Define a variável de sessão de login como verdadeira
                    $_SESSION['ref_perfis'] = $ref_perfis;

                    header("Location: ../index.php");

                } else {
                    header("Location: ../login.php?error=wrongpassword");
                    // mensagem de erro na query string para a password
                }
            } else {
                header("Location: ../login.php?error=nouser");
                // mensagem de erro na query string para o utilizador
            }
        } else {
            header("Location: ../login.php?error=sqlerror");
            // mensagem de erro na query string para o sql
        }

        mysqli_stmt_close($stmt);

    } else {
        header("Location: ../login.php");
    }
?>

