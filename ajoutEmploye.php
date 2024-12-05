<?php
include "header.php";
require "db.php";

?>


<form action="" method="post">


    <div>
        <label class="form-label mt-4">Email</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="email">
    </div>
    <div>
        <label class="form-label mt-4">mot de passe</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="password">

    </div>

    <div>
        <label class="form-label mt-4">nom</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="nom">
    </div>

    <div>
        <label class="form-label mt-4">prenom</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="prenom">
    </div>

    <div>
        <label class="form-label mt-4">service</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="service">
    </div>
    <div>
        <label class="form-label mt-4">salaire</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name="salaire">
    </div>
    <button type="submit" class="btn btn-outline-success" name="envoyer">Ajouter Employer</button>
</form>