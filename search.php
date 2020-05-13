<?php
    include "connection.php";
    if(isset($_GET['s'])){
        $s = mysqli_real_escape_string($conn, $_GET['s']);

        $sql = "SELECT * FROM `fees` WHERE `class` LIKE '$s' OR `student_name` LIKE '%$s%' OR `fee`='$s' OR `Fee_status` LIKE '$s'";
    
         $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)>0){
            ?>
            <table border="1", style="border-collapse:collapse">
            <tr>
                <th>student ID</th>
                <th>student NAME</th>
                <th>student CLASS</th>
                <th>student FEE</th>
                <th>student FEE STATUS</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>

            <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                        echo "<td>".$row['id']."</td>";
                        echo "<td>".$row['student_name']."</td>";
                        echo "<td>".$row['class']."</td>";
                        echo "<td>".$row['fee']."</td>";
                        echo "<td>".$row['fee_status']."</td>";
                        echo "<td><a href='delete.php?id=".$row['id']."' onClick='return confirm(".'"Are you sure you would like to to delete?"'.")'>Delete</a></td>";
                        echo "<td><a href='edit.php?id=".$row['id']."'>Edit</a></td>";
                     echo "</tr>";

                            }
            ?>


        <?php
        }else{
            echo "No result found";
            exit();
        };
    
    }

?>