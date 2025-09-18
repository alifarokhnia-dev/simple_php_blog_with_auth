<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    if (! $_SESSION['signed_in'] == TRUE){
        $_SESSION['message'] = 'please first sign in.';
        $_SESSION['message_class'] = "error";
        header('Location: signin.php');
    }
    ?>
    <form action="store_post.php" method="post">
        <input type="text" name="title" placeholder="enter subject">
        <textarea name="body"></textarea>
        <input type="submit" value="submit">
    </form>
</body>
</html>