<html>
    <form action="signup.php" method="post">
        Username: <input type="text" name="nme"><br>
        email: <input type="text" name="email"><br>
        Password: <input type="password" name="name"><br>
        <input type="submit" name="signup">
    </form>
</html>
<?php
    include "connection.php";

    if(isset($_POST['signup.php'])){
        $uname = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pwd = mysqli_real_escape_string($conn, $_POST['password']);


        if(empty($uname) OR empty($email) OR empty($pwd)){
            header("Location: index.php?message=empty+fields");
            exit();
        }


        //Checking if username already exists
        $sql = "SELECT * FROM `users_sys` WHERE username='$uname'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){
            header("Location: index.php?message=username+exists");
            exit();
        }else{
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $sql2 = "INSERT INTO `users_sys` (`user_username`, `user_email`, `user_password`) VALUES ('$uname', '$email', '$hash');";
            if(mysqli_query($conn, $sql2)){
                header("LOCATION: index.php?message=registration+failed");
            }
        }

    }
?>