<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['admin'] = 1;
if(empty($_SESSION['user_id'])){
    header("Location: ../index.php?error=please_login");
}

include '../includes/database_connection.php';
include '../includes/db_fetches.php';
include '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../css/about.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <title>Millhouse</title>
</head>
<body id="main-page">
<?php
include '../includes/bootstrap_js.php';
?>

<!-- N A V . B A R -->
<nav class="navbar navbar-default navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="main_page.php"><img class="d-inline-block navbarLogo" src="../images/Nav-logo.png"
                                          alt="Millhouse logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbar_options" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto ">
            <li class="nav-item active">
                <a class="nav-link" href="#">Category<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link disabled" href="contact.php">Contact</a>
            </li>
        </ul>
        <?php if($_SESSION["admin"] == 1){?><a href="create_post.php">Create Post</a><?php } ?>
        <form class="form-inline my-2 my-lg-0 loginButton">
            <input class="form-control mr-sm-2" type="hidden" name="login" placeholder="Login"
                   aria-label="Login button">
            <button class="btn btn-default my-2 my-sm-0 " type="submit">Login</button>
        </form>
    </div>
</nav>


<main class="container-fluid">

<img class="img-responsive aboutImage" src="../images/people-coffee-tea-meeting.jpg">
    <section>
        <div data-aos="fade-zoom-in" data-aos-duration="2300" class="row">
        
       
        <div class="col-10 post_parallax">
                <div class="about_text">
                    <h4>Contact us </h4>
                    <p>Email: <a href="mailto:admin@example.com">Millhouse</a></br>
                Phone: 123456789</br></p>
                </div>
            </div>
        </div>
    
    </section>

</main>

<footer role="contentinfo">
        <address>
          <p>For further information, please contact <a href="mailto:admin@example.com">Millhouse</a>.</p>
        </address>
        <small>Copyright &copy; <time>2018</time></small>
</footer>
    
<script>
    AOS.init();
</script>

</body>
</html>