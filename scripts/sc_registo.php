<?php
    include_once "../connections/connection.php";

    if (isset($_POST['name'], $_POST['email'],$_POST['login'], $_POST['password'])) {

        $link = new_db_connection();
        $stmt = mysqli_stmt_init($link);
        $query = "INSERT INTO utilizadores (nome,email, login, password_hash) VALUES (?,?,?,?)";

        echo $query;
        if (mysqli_stmt_prepare($stmt, $query)) {
            $username = $_POST['name'];
            $email = $_POST['email'];
            $login = $_POST['login'];
            $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $login, $password_hash);
            // devemos validar também o resultado do execute!
            if(mysqli_stmt_execute($stmt)){
                header("Location: ../login.php");
            }else{
                header("Location: ../registo.php");
            }

        } else {
            header("Location: ../registo.php");
        }

        mysqli_stmt_close($stmt);
    }else{
        var_dump($_POST['name'], $_POST['email'],$_POST['login'], $_POST['password']);
    }
?>