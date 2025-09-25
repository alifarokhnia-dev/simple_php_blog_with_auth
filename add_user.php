<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "userdb1");
    # check to see if email already exists;
    $sql = "select * from users where email = '$email'";
    $result = $conn->query($sql);
    
    session_start();
    if (mysqli_num_rows($result) > 0){
        $_SESSION['message'] = 'email already exists.';
        $_SESSION['message_class'] = 'error';
        header('Location: signup.php');
    } else {
        $sql = "INSERT INTO users(email, password) VALUES(?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $_SESSION['message'] = "account created successfully! please sign in.";
        $_SESSION['message_class'] = 'success';
        header('Location: signin.php');
    }
}
?>