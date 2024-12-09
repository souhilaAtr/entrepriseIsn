<?php
include "header.php";
require "db.php";
$erreur = null;
@$nom = strip_tags($_POST['nom']);
@$prenom = strip_tags($_POST['prenom']);
@$email = strip_tags($_POST['email']);
$password = @$_POST['password'];
@$service = strip_tags($_POST['service']);
@$salaire = strip_tags($_POST['salaire']);

if (isset($_POST['envoyer'])) {
    // nom
    if (empty($nom)) {
        $erreur = "<li>Veuillez entrer votre nom</li>";
    } elseif (strlen($nom) < 2 || strlen($nom) > 50) {
        $erreur = "<li>Veuillez entrer un nom valide</li>";
    }

    //    prenom
    if (empty($prenom)) {
        $erreur .= "<li>Veuillez entrer votre prenom</li>";
    } elseif (strlen($prenom) < 2 || strlen($prenom) > 50) {
        $erreur .= "<li>Veuillez entrer un prenom valide</li>";
    }
    //   email 
    if (empty($email)) {
        $erreur .= "<li>Veuillez entrer votre email</li>";
    }
    // } elseif (!preg_match(" /^[^\W][a-zA-Z0-9]+(.[a-zA-Z0-9]+)@[a-zA-Z0-9]+(.[a-zA-Z0-9]+).[a-zA-Z]{2,4}$/ ", $email)) {
    //     $erreur .= "<li>l'email est invalide</li>";
    // }
    if (empty($password)) {
        $erreur .= "<li>Veuillez entrer un mot de passe valide</li>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
    }
    if (empty($service)) {
        $erreur .= "<li>Veuillez entrer un service</li>";
    }

    //insertion au niveau de la table employes 

    if (empty($erreur)) {

        try {


            $statement = $pdo->prepare("INSERT INTO employes(nom,prenom,email,password,salaire,service)VALUES(:nm,:prenom,:email,:password,:salaire,:service)");
            $statement->execute([
                "nm" => $nom,
                "prenom" => $prenom,
                "email" => $email,
                "password" => $hash,
                "service" => $service,
                "salaire" => $salaire

            ]);
            header("location: employes.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


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
<?php if (!empty($erreur)) { ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><?= $erreur ?></strong>
    </div>

<?php } ?>