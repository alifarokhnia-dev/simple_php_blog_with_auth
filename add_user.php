<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "userdb");
    # check to see if email already exists;
    $sql = "select 1 from users where email = '?'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    session_start();
    echo $result['email'];
    if (! $result === []){
        $_SESSION['message'] = 'email already exists.';
        $_SESSION['message_class'] = 'error';
        header('Location: signup.php');
    } else {
        $sql = "INSERT INTO users(fullname, email, password) VALUES(?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, password_hash($password));
        $stmt->execute();
        $_SESSION['message'] = "account created successfully!";
        $_SESSION['message_class'] = 'success';
        header('Location: signin.php');
    }
}
?>