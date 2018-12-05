<?php

//Start session for comment and admin 
session_start();

//get database connection once
require_once '../includes/database_connection.php';
require_once '../includes/functions.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <title>Document</title>
</head>
<body>
    <!--Load single post function-->
    <?php getSinglePost($pdo);?> </br>
    
    <!--Display post image-->
    <img src="../<?=fetchArrayi['imgPath']?>" alt="Cool Post Image">
    <!--Display post title-->
    <h1>Title</h1>
    <!--Display post category-->
    <h2>Category</h2>
    <!--Display post date-->
    <h3>Date</h3>
    <!--Display post -->
    <p>Random post text</p>
    
    <!--Add comment form-->
    <div class="panel panel-default">
        <div class="panel-heading">Submit Your Comments</div>
        <div class="panel-body">
            <form method="post" action="../includes/commentform.php"> 
            <div class="form-group">
                <label for="single_comment">Comment</label>
                <textarea id="single_comment" name="content" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
            <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        </div>
    </div>

<?php 
    include '../includes/bootstrap_js.php';
?>

</body>
</html>