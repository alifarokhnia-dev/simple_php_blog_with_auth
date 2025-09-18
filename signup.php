<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{color: red;}
        .success{color:green;}
        .warn{color: yellow;}
    </style>
</head>
<body>
    <?php
        session_start();
        # check if already signed in
        if ($_SESSION['signed_in'] == TRUE){
            $_SESSION['message'] = "you already signed in";
            header('Location: posts.php');
        }
        # show messages
        if (isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            $message_class = $_SESSION['message_class'];
            echo "<p class='$message_class'>$message</p>";
        }
        unset($_SESSION['message']);
        unset($_SESSION['message_class']);
    ?>
    <form action="add_user.php" method="post">
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="submit">
    </form>
    <a href="http://localhost/signin.php">already have an account? sign in</a>
</body>
</html>