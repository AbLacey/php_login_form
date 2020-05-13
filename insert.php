<?php
session_start();

if(!isset($_SESSION['id'])){
    header("Location: show.php");
    exit();
}else{ ?>

<!DOCTYPE html>
<html>
<head>
    <title>INSERT A REORD</title>
</head>
<body>
    <form method="post">
        STUDENT NAME: <input type="text" name="name" required><br>
        STUDENT CLASS: <input type="text" name="class" required><br>
        STUDENT FEES: <input type="text" name="fee" required><br>
        FEE STATUS: <select name="Fee_status">
                        <option value="paid">Paid</option>
                        <option value="unpaid">UnPaid</option>
                    </select><br>
        <input type="submit" name="submit">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $name = mysqli_real_escape_string($conn,$_POST['name']);
            $class =mysqli_real_escape_string($conn,$_POST['class']);
            $fee = mysqli_real_escape_string($conn,$_POST['fee']);
            $Fee_status = $_POST['Fee_status'];

            $conn = mysqli_connect("localhost", "root", "root", "myfirstdb");

            $sql = "INSERT INTO `fees` (`student_name`, `class`, `fee`, `Fee_status`) VALUES ('$name', '$class', '$fee', '$Fee_status');";

            if(mysqli_query($conn, $sql)){
                echo "<h2>Record Added Successfully!</h2>";
                header("Location: show.php?message=recordAdded");
            };
          
        }

    ?>
</body>
</html>
<?php } ?>