<?php
session_start();
$usr = "nina";
$psd = "azerty"; // 

if (!empty($_GET['flag'])) {
    session_unset();
    unset($_SESSION);
}
if (isset($_POST['send'])) {
    if ($_POST['username'] === $usr && $_POST["password"] === $psd) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
    }
}
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
    echo "welcome   " . $_SESSION['username'];

?>

    <a href="session.php?flag=true">Deconnexion</a>
<?php









} else {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <form action="" method="post">
            <input type="text" name="username">
            <input type="text" name="password">
            <button type="submit" name="send">send</button>
        </form>
    </body>

    </html>

<?php
}
?>