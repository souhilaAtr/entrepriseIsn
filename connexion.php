<?php

include "header.php";
require "db.php";

if (isset($_POST['connexion'])) {
    // var_dump($_POST);
    $sql = "select * from  employes where email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        'email' => $_POST['email']
    ]);
    $employe = $statement->fetch();
    var_dump($employe);
    if (password_verify($_POST['password'], $employe['password'])) {
        $_SESSION['id']= $employe['id_employes'];
        header("location:profil.php");
    } else {
        echo "mot de passe incorrect";
    }
}


?>
<form action="" method="post">

    <div>
        <label for="exampleInputEmail1" class="form-label mt-4">Email address</label>
        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div>
        <label for="exampleInputPassword1" class="form-label mt-4">Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
    </div>
    <div>
        <button type="submit" class="btn btn-outline-warning" name="connexion">connexion</button>

</form>

<a href="ajoutEmploye.php">si vous n'avez pas de compte </a>