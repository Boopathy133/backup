<?php
if (isset($_POST['submit'])) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $con=mysqli_connect("localhost","root","","collage");
    $result = mysqli_query($con, "SELECT * From register Where email='$email' AND password='$password'");
    $row= mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) >0 ) {
        echo "Login succefull";
    }else {
        echo "User not registerd";
    }
}
?>