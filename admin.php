<?php

include('config.php');

session_start();

$loggedIn='';

if (isset($_SESSION['loggedIn'])) {
    $loggedIn = ($_SESSION['loggedIn']);
}
else {
    header("Location:login.php");
}

if (isset($_POST['create'])) {
    header('Location:create.php');
}

$selectQuery = "SELECT * FROM projects";
$projects = [];

if (!($resultAllProjects = mysqli_query($db, $selectQuery))) {
    $error = "Er is iets fout gegaan: " . mysqli_error($db) . ' QUERY: ' . $selectQuery;
} else {
    while ($row = mysqli_fetch_assoc($resultAllProjects)) {
        $projects[] = $row;
    }
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:home.php");
}


?>

<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Dennie van der Starre</title>
    <link rel="stylesheet" href="layout.css">
    <link rel="stylesheet" href="admin.css">

</head>


<body>

<div id="banner">
    <h1>
        Admin
    </h1>
    <div id="nav">
        <form method="post" action="admin.php">
            <input id="submit" type="submit" name="logout" value="Logout">
        </form>
        <form method="post" action="create.php">
            <input id="submit" type="submit" name="create" value="Create">
        </form>
    </div>
</div>

<div id="container">
    <div id="content">
        <?php if (isset($error)) { ?>
            <span class="error"><?= $error; ?></span>
        <?php } ?>

        <?php if (!empty($projects)) { ?>
            <table id="projects">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Project URL</th>
                    <th>Code URL</th>
                    <th>Image URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($projects as $project) { ?>
                    <tr>
                        <td id="name"><?= $project['name']; ?></td>
                        <td id="description"><?= $project['description']; ?></td>
                        <td id="link"><?= $project['projectlink']; ?></td>
                        <td id="link"><?= $project['codelink']; ?></td>
                        <td id="link"><?= $project['imglink']; ?></td>
                        <td id="action"><a type="button" href='edit.php?Id=<?=$project['id'] ?>'>Edit</a> | <a type="button" href='delete.php?Id=<?=$project['id'] ?>'>Delete</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>

</div>

</body>
</html>
