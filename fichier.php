<?php


// var_dump($_FILES);
if (isset($_POST['send'])) {
    $file = $_FILES['fichier'];
    $filname = $file['name'];
    $fileerror = $file['error'];
    $filetype = $file['type'];
    $filetmp = $file['tmp_name'];
    $filesize = $file['size'];
    $fichiertelechargement = "upload";



    if (!file_exists($fichiertelechargement)) {
        mkdir($fichiertelechargement);
    }

    $tableauExtension = ['pdf', 'png', 'jpg', 'gif'];

    $ext = explode(".", $filname);

    $fileext = strtolower(end($ext));


    if (in_array($fileext, $tableauExtension)) {
        if (empty($fileerror)) {
            if ($filesize < 500000) {

                $uniqid = uniqid("fichier--") . "." . $fileext;
                $newfinename = $fichiertelechargement . "/" . $uniqid;


                move_uploaded_file($filetmp, $newfinename);
            } else {
                echo "la taille ne doit pas dépasser 500ko";
            }
        } else {
            echo "fichier invalide";
        }
    } else {
        echo "extension invalide (pdf, png,jpg,gif)";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">

        <input type="file" name="fichier">
        <button type="submit" name="send">send</button>
    </form>
</body>

</html>