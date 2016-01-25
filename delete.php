<?php

include('config.php');

if(isset($_GET['Id']))
{
    $id = $_GET['Id'];
    $query = mysqli_query($db, "DELETE FROM projects WHERE id ='$id'");
    if($query)
    {
        header('location:admin.php');
    }
}

?>
