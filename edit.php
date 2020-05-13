<?php
   session_start();

   if(!isset($_SESSION['id'])){
       header("Location: show.php");
       exit();
   }else{

   include "connection.php";

    if(isset($_GET['id'])){
        $id = $_GET['id'];
       // echo "You are edithing $id";
       $sql = "SELECT * FROM `fees` WHERE id='$id'";
       $result = mysqli_query($conn, $sql);
       while($row= mysqli_fetch_assoc($result)){
           ?>
        <form method="post">
            STUDENT NAME: <input type="text" name="name" value="<?php echo $row['student_name']; ?>" required><br>
            STUDENT CLASS: <input type="text" name="class" value="<?php echo $row['class']; ?>" required><br>
            STUDENT FEES: <input type="text" name="fee" value="<?php echo $row['fee']; ?>" required><br>
            FEE STATUS: <select name="Fee_status">
                            <option value="paid" <?php if($row['fee_status']=="paid"){echo "selected";} ?>>Paid</option>
                            <option value="unpaid" <?php if($row['fee_status']=="unpaid"){echo "selected";} ?>>UnPaid</option>
                        </select><br>
            <input type="submit" name="submit">
        </form>

        <?php
            if(isset($_POST['submit'])){
                $name = $_POST['name'];
                $class = $_POST['class'];
                $fee = $_POST['fee'];
                $Fee_status = $_POST['Fee_status'];

                $sql2 = "UPDATE `fees` SET `student_name`='$name',`class`='$class',`fee`='$fee',`fee_status`='$Fee_status' WHERE id='$id' ";

                if(mysqli_query($conn, $sql2)){
                    header("Location:show.php?updated+successfully");
                }
            }

        

       }

    }else{
        header("Location:show.php");
    }
}

?>