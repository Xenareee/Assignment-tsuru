<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <title>tsuru!</title>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="styles.css">
    <script src="jquery-3.6.4.min.js"></script>
    <script src="javascript.js" ></script>
</head>
<body>
    <div id="background"></div>
    <header><?php
        if (isset($_SESSION["username"])) {
            echo('<a href="index.php?page=dashboard" id="logo"></a>');
        }
        else {
            echo('<a href="index.php?page=home" id="logo"></a>');
        }
    ?>
        <a href="index.php?page=kanji">Kanji</a>
        <a href="index.php?page=search">Szukaj</a>
        <a href="index.php?page=explore">Eksploruj</a>
        <div id="account-header"><?php 

        if (isset($_SESSION["username"])) {
            echo('<div id="account-header-profilepicture" style="background-image: url(images/profilepicture' . str_pad($_SESSION['profilepicture'], 2, "0", STR_PAD_LEFT) . '.png)"></div>');
            echo('<a id="account-header-username" href="index.php?page=account">' . $_SESSION["username"] . '</a>');
            echo('<div id="account-dropdown">');
                echo('<a href="index.php?page=account">Konto</a>');
                echo('<a href="index.php?page=log-out">Wyloguj się</a>');
            echo('</div>');
        }
        else {
            echo('<a id="account-header-username" href="index.php?page=log-in">Zaloguj się</a>');
            echo('<div id="account-dropdown">');
                echo('<a href="index.php?page=log-in">Logowanie</a>');
                echo('<a href="index.php?page=sign-in">Rejestracja</a>');
            echo('</div>');
        }
        
        ?></div>
    </header>
    <main>
        <article id="article">
            <?php

            if (isset($_GET['page']))
                $page = $_GET['page'];
            else
                //$page = 'home';
                echo('<script>MainPage();</script>');

            if (file_exists('subpages/' . $page . '.php')) {

                // unlogged user restrictions
                if (!isset($_SESSION['username'])) {
                    if ($page == 'log-out' || $page == 'account' || $page == 'dashboard' || $page == 'review') {
                        //$page = 'home';
                        echo('<script>MainPage();</script>');
                    }
                }
                // logged user restrictions
                else {
                    if ($page == 'log-in' || $page == 'sign-in') {
                        //$page = 'log-out';
                        echo('<script>Redirect("log-out");</script>');
                    }
                    else if ($page == 'home') {
                        echo('<script>Redirect("dashboard");</script>');
                    }
                }

                include('subpages/' . $page . '.php');
            }    
            else
                include('subpages/404.php');

            ?>
        </article>
    </main>
    <footer>
        <a href="https://github.com/Xenareee">Xenareee</a> 2023 ● <a href="index.php?page=about">O Stronie</a>
    </footer>
</body>
</html>