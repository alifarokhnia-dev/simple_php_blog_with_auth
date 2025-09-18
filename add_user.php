<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $conn = new mysqli("localhost", "root", "", "userdb");
    # check to see if email already exists;
    $sql = "select 1 from users where email = '$email'";
    $result = $conn->query($sql);
    
    session_start();
    if (mysqli_num_rows($result) > 0){
        $_SESSION['message'] = 'email already exists.';
        $_SESSION['message_class'] = 'error';
        header('Location: signup.php');
    } else {
        $sql = "INSERT INTO users(fullname, email, password) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $_SESSION['message'] = "account created successfully!";
        $_SESSION['message_class'] = 'success';
        header('Location: signin.php');
    }
}
?>