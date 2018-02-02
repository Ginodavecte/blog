<?php session_start();?>
<?php include("../includes/databases/databaseBLOGw3.php");?>
<?php include("includes/functions.php");?>

<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <link rel="stylesheet" type="text/css" href="stylesheets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<?php

if(isset($_SESSION['current_user_id'])){

    ?>  <h4>Kies hier uw gewenste keuze</h4>
    <ul>
        <li><a href="blog/read.php">Lees de geplaatste artikelen.</a></li>
        <li><a href="blog/write.php">Schrijf zelf een artikel.</a></li>
        <li><a href="../index.php">Ga terug</a></li>
    </ul>
    <?php


}else{  //else van eerste if. if session user isset
    redirect_to("login/login.php");
}
?>
