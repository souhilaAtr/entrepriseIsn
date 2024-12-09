<?php

include "header.php";
require "db.php";

// var_dump($_SESSION);
$stat = $pdo->prepare("SELECT * from employes where id_employes = :id");
$stat->execute([
    "id" => $_SESSION['id']
]);

$employe = $stat->fetch();

?>
<div class="card">
    <!--<img src="img_avatar.png" alt="Avatar" style="width:100%"> -->
    <div class="container">
        <h4><b><?= $employe['nom'] ?> </b></h4>
        <h4><b><?= $employe['prenom'] ?> </b></h4>
        <p><?= $employe['service'] ?></p>
    </div>
</div>