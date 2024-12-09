<?php

include "header.php";

require "db.php";


try {
    $sql = "SELECT * FROM employes";
    $statement = $pdo->query($sql);
    $employes = $statement->fetchAll();
    // var_dump($employes);

?>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">nom</th>
                <th scope="col">prenom</th>
                <th scope="col">email</th>
                <th scope="col">service</th>
                <th scope="col">salaire</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employes as $employe) { ?>
                <tr class="table-secondary">
                    <td><?= $employe['id_employes'] ?></td>
                    <td><?= $employe['nom'] ?></td>
                    <td><?= $employe['prenom'] ?></td>
                    <td><?= $employe['email'] ?></td>
                    <td><?= $employe['service'] ?></td>
                    <td><?= $employe['salaire'] ?></td>
                    <td><a href="modifier.php?id_employes=<?= $employe['id_employes'] ?>">modifier info</a></td>
                    <td><a href="supprimer.php?id_employes=<?= $employe['id_employes']?>">suppression</a></td>
                </tr>
            <?php  } ?>
        </tbody>
    </table>




<?php












} catch (PDOException $error) {
    echo $error->getMessage();
}
