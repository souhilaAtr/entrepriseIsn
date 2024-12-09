<?php

include "header.php";






// var_dump($hash);

if (isset($_POST['connexion'])) {
    $hash = password_hash($motdepasse, PASSWORD_DEFAULT);
   }


   if(password_verify($password,$hash)){
    echo "mot de passe correct";
   }else{

    ?>

    <form action="" method="post">
        <input type="text" name="mail">
        <input type="password" name="mdp">

        <button type="submit" name="connexion">Connexion</button>
    </form>
<?php }?>