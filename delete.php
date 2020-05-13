<?php
    session_start();

    if(!isset($_SESSION['id'])){
        header("Location: show.php");
        exit();
    }else{

    
        include "connection.php";

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "DELETE FROM `fees` WHERE id='$id'";

            if(mysqli_query($conn, $sql)){
                header("Location:show.php?Deleted+successfully");
            }
        }else{
            header ("LOCATION: show.php");
        }
    }

?>