<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $conn = new mysqli('localhost', 'root', '', 'userdb1');

        $q = "select * from users where email = '$email'";
        $result = mysqli_query($conn, $q);
        $result = mysqli_fetch_assoc($result);
        
        session_start();
        if ($result['password'] == $password | password_verify($password, $result['password'])){
            $_SESSION['signed_in'] = TRUE;
            $_SESSION['userId'] = $result['id'];
            $_SESSION['message'] = "you entered successfully!";
            $_SESSION['message_class'] = "success";
            header('Location: posts.php');
        } else {
            $_SESSION['message'] = "email or password is not valid.";
            $_SESSION['message_class'] = 'error';    
            header('Location: signin.php');
        }
    }
?>