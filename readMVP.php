<?php session_start();?>
<?php include("../includes/database.php");?>
<?php include("../includes/functions.php");?>

<head>
    <meta charset="UTF-8">
    <title>Blog-lezen</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<?php
if(isset($_SESSION['current_user_id'])) {
    $user_id = $_SESSION['current_user_id'];
    $sql = "SELECT * FROM article,users WHERE users.id = article.user_id ORDER BY article.id DESC";
    $result = mysqli_query($connection, $sql);
    $subjects = mysqli_fetch_all($result,MYSQLI_BOTH);

    foreach($subjects as $subject) {
        ?>
        <table>
            <tr>
                <td><?php echo $subject['username']; ?></td>
                <td><?php echo $subject['article_title']; ?></td>
            </tr>
            <tr>
                <td><?php echo $subject['date']; ?></td>
                <td><?php echo $subject['article']; ?></td>
            </tr>
        </table>


        <?php
    }   //sluit foreach
    }else{  //else van eerste if. if session user isset
        redirect_to("login/login.php");
    }
?>