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
$avatar = $_FILES['avatar'];
$avatarname = $avatar['name'];
$avatarSize = $avatar['size'];
$avatartmp = $avatar['tmp_name'];
$avatarerror = $avatar['error'];
$tableauExtension = ['png','jpg','gif','jpeg'];

$myextension = strtolower(end(explode(".",$avatarname)));


$upload = "avatar";

if (!file_exists($upload)) {
    mkdir($upload);
}


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
                        if(!in_array($myextension, $tableauExtension)){
                            $erreur .= "<li>l'extension n'est pas valide</li>";
                        }
                        if(!empty($avatarerror)){
                            $erreur .= "<li> la photo est invalide </li>";
                        }
                        if($avatarSize >4000000){
                            $erreur .= "<li> la taille de la photo ne doit pas depasser 4mb</li>";
                        }




    //insertion au niveau de la table employes 

    if (empty($erreur)) {

                    $uniqid = uniqid("avatar--").".". $myextension;
                    $filedist = $upload."/".$uniqid;
                    move_uploaded_file($avatartmp,$filedist);


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
            // header("location: employes.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>


<form action="" method="post" enctype="multipart/form-data">


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
    <div>
        <label for="formFile" class="form-label mt-4">photo de profil</label>
        <input class="form-control" type="file" id="formFile" name="avatar">
    </div>



    <button type="submit" class="btn btn-outline-success" name="envoyer">Ajouter Employer</button>





</form>
<?php if (!empty($erreur)) { ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong><?= $erreur ?></strong>
    </div>

<?php } ?>