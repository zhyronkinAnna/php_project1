<?php
require_once "./functions/main.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/style.css">
  
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="node_modules/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="node_modules/slick-carousel/slick/slick-theme.css"/>
    <script type="text/javascript" src="node_modules/slick-carousel/slick/slick.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/uploads">Uploads</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reviews">Reviews</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/registration">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">LogIn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/manage-sliders">Manage Sliders</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        $page = $_GET['page'] ?? 'home';

        if (file_exists("./pages/$page.php")) {
            require_once "./pages/$page.php";
            OldInputs::clear();
        } else {
            echo '<h1>Page Not Found</h1>';
        }
        ?>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>