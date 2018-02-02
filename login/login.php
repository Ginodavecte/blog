<?php session_start(); ?>
<?php include("../../includes/databases/databaseBLOGw3.php");?>
<?php include("../includes/functions.php");?>

<?php
$error = "";
?>

<head>
    <meta charset="UTF-8">
    <title>Log-in</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = htmlentities($_POST['username']);
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $sql);
    $subjects = mysqli_fetch_assoc($result);


    if($result -> num_rows < 1){ //Kijken of username al bestaat zo niet dan voeg username toe aan db en zet username in session
        $sql = "INSERT INTO users (username) VALUES ('$username')";
        $result = mysqli_query($connection, $sql);
        $sql2 = "SELECT * FROM users WHERE username = '$username'";
        $result2 = mysqli_query($connection, $sql2);
        $subjects = mysqli_fetch_assoc($result2);
        $_SESSION['current_user_id'] = $subjects['id']; /* toevoegen van user_id aan session kan nu overal gebruikt worden.
                                                 BEGIN ELK SCRIPT MET SESSION_START()*/
        redirect_to("../index.php");
    }else{
        $error = "Your username is already is use.";
    }
}
?>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-default col-md-6">
            <form action="" method="post">
                <div class="panel-heading" style="background-color: #3d6da7 !important; color: white !important;">Login as user </div>
                <div class="panel-body">
                    <p><input type="text" name="username" placeholder="Your Username" required> <?php echo $error; ?> </p>

                    <input type="submit" class="btn btn-warning btn-sm" name="login_submit" value="Log-in">
                </div>
            </form>
        </div> <!-- eind div col-md-6 -->
    </div> <!-- eind div row -->
</div> <!-- eind div container -->