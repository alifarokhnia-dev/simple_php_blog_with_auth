<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $conn = new mysqli('localhost', 'root', '', 'userdb1');

    $userId = $_SESSION['userId'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $q = "insert into posts(userId, title, body) values(?, ?, ?);";
    $stmt = $conn->prepare($q);
    $stmt->bind_param('iss', $userId, $title, $body);
    $stmt->execute();
    
    $_SESSION['message'] = 'post been created successfully!';
    $_SESSION['message_class'] = "success";
    header('Location: posts.php');
}
?>