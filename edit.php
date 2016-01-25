<?php

session_start();

include('config.php');

$loggedIn='';

if (isset($_SESSION['loggedIn'])) {
    $loggedIn = ($_SESSION['loggedIn']);
}
else {
    header("Location:login.php");
}

if (isset($_POST['back'])) {
    header('Location:admin.php');
}

$row = '';

if(isset($_GET['Id']))
{
    $id = ($_GET['Id']);
    $query = mysqli_query($db, "SELECT * FROM projects WHERE id ='$id'");
    if($query)
    {
        ($row = mysqli_fetch_assoc($query));
    }
}

if(isset($_POST['editSubmit'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $projectlink = $_POST['projectUrl'];
    $codelink = $_POST['sourceUrl'];
    $imglink = $_POST['imgUrl'];

    $query = mysqli_query($db, "UPDATE projects SET name ='$name', description ='$description', projectlink ='$projectlink', codelink ='$codelink', imglink ='$imglink' WHERE id ='$id'");

    if($query)
    {
        header('Location:admin.php');
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Dennie van der Starre</title>
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="create.css">

</head>

<body>

<div id="banner">
    <h1>
        Edit
    </h1>
    <div id="nav">
        <form method="post" action="admin.php">
            <input id="submit" type="submit" name="back" value="Back">
        </form>
    </div>
</div>

<div id="container">
    <div id="content">
        <?php if (!empty($row)) { ?>
            <form method="post" action="edit.php">
                <input id="editId" type="hidden" name="id" placeholder="Project Name" value="<?= $row['id']; ?>"><br>
                <input id="createInput" type="text" name="name" placeholder="Project Name" value="<?= $row['name']; ?>"><br>
                <textarea id="createInput" name="description" placeholder="description"><?= $row['description']; ?></textarea><br>
                <input id="createInput" type="text" name="projectUrl" placeholder="URL to project" value="<?= $row['projectlink']; ?>"><br>
                <input id="createInput" type="text" name="sourceUrl" placeholder="URL to code" value="<?= $row['codelink']; ?>"><br>
                <input id="createInput" type="text" name="imgUrl" placeholder="URL to image" value="<?= $row['imglink']; ?>"><br>
                <input id="createSubmit" type="submit" name="editSubmit" value="Apply changes" style="margin 20px auto"; ><br>
            </form>
        <?php } ?>

    </div>

</div>



</body>
</html>
