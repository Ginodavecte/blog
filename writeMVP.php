<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>
    <head>
        <meta charset="UTF-8">
        <title>Blog-plaatsen</title>
        <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

<?php
if(isset($_SESSION['current_user_id'])){

    if(isset($_POST['submitPost'])){
            $user_id = $_SESSION['current_user_id'];
            $article = htmlentities($_POST['article']);
            $title = htmlentities($_POST['title']);
            date_default_timezone_set("Europe/Amsterdam");
            $date = date("Y-m-d H:i:s");
            $sql = "INSERT INTO article (user_id, article_title, article, category_id, date)
                    VALUES ('$user_id', '$title', '$article', '', '$date')";
            $result = mysqli_query($connection, $sql);

            echo "Uw artikel is succesvol geplaats!";
    }





?>
    <form action="" method="post">
        <input type="text" name="title" placeholder="Type here you article title..."> <br>
        <textarea name="article" rows="10" cols="30" placeholder="Type here your article..."></textarea><br>
        <input type="submit" class="btn btn-success btn-sm" name="submitPost" value="Post">
    </form>

    <?php


}else{  //else van eerste if. if session user isset
    redirect_to("login/login.php");
}

    ?>