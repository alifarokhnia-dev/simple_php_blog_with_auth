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
        .menu{
            width: 100%;
            margin: auto;
            background-color: black;
        }
        .menu a{
            display: inline-block;
            text-decoration: none;
            color: white;
            height: 100%;
            padding: 20px 20px;
        }
        .menu a:hover{
            background-color: white;
            color: darkblue;
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
<div class="menu">
    <?php
        session_start();
        # if signed in/out show different buttons respectivly.
        if ($_SESSION['signed_in'] == TRUE){
            echo '<a href="signout.php">sign out</a><a href="add_post.php">add post</a>';
        }
        else {
            echo '<a href="signin.php">sign in</a><a href="signup.php">sign up</a>';
        }
    ?>
</div>
    <?php
        # check if there are any messages to show to the user, if it is then show them.
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
        $conn = new mysqli("localhost", "root", "", "userdb1");
        $sql = "select * from posts";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $posts = array_reverse($stmt->get_result()->fetch_all(MYSQLI_ASSOC)); # see the new ones first

        foreach($posts as $p){
            $created_at = $p['created_at'];
            $title = $p['title'];
            $body = $p['body'];
            $author = $p['userId'];
            echo "<div class='post'><h3 class='post-title'>$title</h3><p class='post-body'>$body</p><span class='post-timestamp'>$created_at</span><span class='post-author'> author: $author</span></div>";
        }
    ?>
</div>
</body>
</html>