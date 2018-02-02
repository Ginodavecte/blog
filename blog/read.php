<?php session_start();?>
<?php include("../../includes/databases/databaseBLOGw3.php");?>
<?php include("../includes/functions.php");?>

<head>
    <meta charset="UTF-8">
    <title>Blog-lezen</title>
    <link rel="stylesheet" type="text/css" href="../stylesheets/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php
if(isset($_SESSION['current_user_id'])) {

if(isset($_POST['submitChoice'])){   //VOOR DE SUBMIT VAN DE KEUZE VAN CATEGORIE !!!! MOET NOG GEMAAKT WORDEN
$category_choice = $_POST['category'];
$user_id = $_SESSION['current_user_id'];
$sql = "SELECT * FROM article,users WHERE category_id = '$category_choice'
            AND users.id = article.user_id ORDER BY article.id DESC";
$result = mysqli_query($connection, $sql);
$subjects = mysqli_fetch_all($result,MYSQLI_BOTH);
?>
<div class="container">
    <h1>Extra! Extra! Read All About It!</h1>
    <?php
    foreach($subjects as $subject) {

        ?>
        <div class="well">
            <div class="media">
                <a class="pull-left">
                    <?php if(!empty($subject['article_img'])){ echo  '<img src="data:image/jpeg;base64,'.base64_encode( $subject['article_img'] ).'" height="100" width="100"/>';}
                    else{ echo '<img src="../includes/img/fcgroningenlogo.jpg" height="100" width="150"/>';}
                    ?>
                </a>
                <div class="media-body">
                    <h4 class="media-heading"><?php echo $subject['article_title'];?></h4>
                    <p class="text-right"><?php echo $subject['username'];?></p>
                    <p><?php echo $subject['article'];?></p>
                    <ul class="list-inline list-unstyled">
                        <li><span><i class="glyphicon glyphicon-calendar"></i><?php echo $subject['date'];?></span></li>
                        <!--                            <li>|</li>-->
                        <!--                            <span><i class="glyphicon glyphicon-comment"></i> 2 comments</span>-->
                        <!--                            <li>|</li>-->
                    </ul>
                </div>
            </div>
        </div>

        <?php
    }   //sluit foreach
    }// sluit if statement submit Choise voor categorie

    //dropdown voor kiezen catagory
    ?>
    <!-- Category input-->
    <div class="form-group">
        <label class="col-md-3 control-label" for="name">Category : </label>
        <form action="" method="post">
            <div class="col-md-9">
                <?php
                $sql = "SELECT * FROM category ORDER BY id";
                $result = mysqli_query($connection, $sql);
                $selected_venue_id = "";
                echo "<select name = 'category' class=\"form-control\" required>";
                ?>
                <option selected disabled value="">Choose your category</option>
                <?php
                while (($row = mysqli_fetch_array($result)) != null) {
                    echo "<option value = '{$row['id']}'";
                    if ($selected_venue_id == $row['id'])
                        echo "selected = 'selected'";
                    echo ">{$row['name']}</option>";
                }
                echo "</select required>"; ?>
            </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 text-right">
            <input type="submit" class="btn btn-success btn-sm" name="submitChoice" value="Lezen!">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <a href="../index.php">Ga terug</a>
        </div>
    </div>
    </form>
    <?php
    }else{  //else van eerste if. if session user isset
        redirect_to("../login/login.php");
    }
    ?>
</div>   <!--eind div container -->
</body>