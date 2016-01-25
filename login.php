<?php
session_start();

include('config.php');

if (isset($_POST['submit'])) {
    header('Location:home.php');
}

$message="";

if (isset($_POST['submitLogin'])) {
    $query = "SELECT * FROM user WHERE username =
        '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
    $result = mysqli_query($db, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $_SESSION['loggedIn'] = true;
        header("Location:admin.php");

    } else {
        $message = "Ongeldige login.";
    }
}

?>
