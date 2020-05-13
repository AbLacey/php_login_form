<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <title>SHOW ALL RECORDs</title>
    <style>
        td{
            text-align:right;
        }
        th{
            padding:10px;
            background-color:grey;
        }
        #container{
            width:80%;
            margin:auto;
            background-color:#ebebeb;
            height:auto;
        }
        body{
            padding:0;
            margin:0;
        }
        $sidebar{
            width:30%;
            float:left;
        }
        #content{
            width:70%;
            float:right;
        }
        #footer{
            clear:both;
            background-color:black;
            color:white;
            text-align:center;
        }
    </style>
</head>
<body>
<div id="container">
        <div id="sidebar">
            <form action="search.php">
                <input type="text" name="s" placeholder="search here">
                <input type="submit" name="submit">
            </form>

                <?php
                    
                include "connection.php";

                $sql = "SELECT * FROM `fees` ";
                $result = mysqli_query($conn, $sql);
            ?>
            <?php if (isset($_SESSION['id'])){
                ?>
                <a href="logout.php"><button>LogOut</button></a>
                <a href="insert.php"><button>Insert</button></a>
                
                <?php

            }else{ ?>
            <form action="login.php" method="post">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit" name="submit" value="login">
            </form><?php } ?>
       
        </div>
        <div id="content">
                <table border="1", style="border-collapse:collapse">
                    <tr>
                        <th>student ID</th>
                        <th>student NAME</th>
                        <th>student CLASS</th>
                        <th>student FEE</th>
                        <th>student FEE STATUS</th>
                        <?php if(isset($_SESSION['id'])) {?>
                        <th>Delete</th>
                        <th>Edit</th>
                        <?php } ?>
                    </tr>
                    
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['student_name']."</td>";
                                echo "<td>".$row['class']."</td>";
                                echo "<td>".$row['fee']."</td>";
                                echo "<td>".$row['fee_status']."</td>";
                                //removing the edit and delete function when not signed in
                                if(isset($_SESSION['id'])){
                                echo "<td><a href='delete.php?id=".$row['id']."' onClick='return confirm(".'"Are you sure you would like to to delete?"'.")'>Delete</a></td>";
                                echo "<td><a href='edit.php?id=".$row['id']."'>Edit</a></td>";
                                }    
                                echo "</tr>";

                                    }
                    ?>
                </table>
        </div>
        
        <div id="footer">Login System for Fees Project | Designed by Abraham &copy;2020</div>
</div>

</body>
</html>