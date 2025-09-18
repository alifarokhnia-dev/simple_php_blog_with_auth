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
        body{
            margin:0;
            padding:0;
        }
        .post-container{
            margin: 20px auto;
            width: 80%;
            padding: 20px;
            background-color: darkblue;
        }
        .post{
            width: 90%;
            background-color: black;
            color: white;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            $message_class = $_SESSION['message_class'];
            echo "<p class='$message_class'>$message</p>";
        }
        unset($_SESSION['message']);
        unset($_SESSION['message_class']);
    ?>
<div class='post-container'>
    <?php 
        $conn = new mysqli("localhost", "root", "", "blogdb");
        $sql = "select * from posts";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $posts = $stmt->get_result();
        foreach($posts as $p){
            $created_at = $p['created_at'];
            $title = $p['title'];
            $body = $p['body'];
            $author = $p['author'];
            echo "<div class='post'><h3 class='post-title'>$title</h3><p class='post-body'>$body</p><span class='post-timestamp'>$created_at</span><span class='post-author'>$author</span>";
        }
    ?>
</div>
</body>
</html>