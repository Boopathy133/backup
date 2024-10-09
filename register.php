<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($username) || !empty($email) || !empty($password)) {
    # code...
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "collage";
    
    $con= mysqli_connect($host,$dbusername,$dbpassword,$dbname);
    if (mysqli_connect_error()) {
        die ('Connect Error ('.mysqli_connect_errno().')'.(mysqli_connect_error()));
    }else {
        $SELECT = "SELECT email From register Where email = ? Limit 1";
        $INSERT = "INSERT Into register (username,email,password) values (?,?,?)";

        $stmt=$con->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;

        if ($rnum==0) {
            $stmt->close();
            $stmt=$con->prepare($INSERT);
            $stmt->bind_param("sss",$username,$email,$password);
            $stmt->execute();
            echo "New recor added";
        }else {
            echo "Someone already regitered using this email";
        }
        $stmt->close();
        $con->close();
    }
}else{
    echo "All field are required";
}
?>