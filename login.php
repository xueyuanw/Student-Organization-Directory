<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/29/16
 * Time: 21:19
 */

session_start();
unset($_SESSION["loggedin"]);
?>


<head lang="en">
    <meta charset="UTF-8">
    <title>USC Student Organizations Directory</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
<nav>

    <div id="nav-wrapper">
        <a id="usc-logo" href="http://usc.edu" target="new">University of Southern California </a>

        <div id="home">
            <a href="home.php">Home</a>
        </div>
        <div id="login">
            <a href="login.php">Log In</a>
        </div>
        <div id="signup">
            <a href="signup.php">Sign Up</a>
        </div>
    </div>
</nav>

<header>
    <!-- <img id="header-img" src="http://i.imgur.com/Kbw9HeQ.jpg"> -->
    <div id="img-caption">
        USC Student Organizations Directory
    </div>
</header>

<article>

    <div id="signupform">
        Don't have an account?<br/>
        <button><a href="signup.php"> Sign Up</a></button>
    </div>

    <form method="post" action="profile2.php">
        Username: <input type="text" name="username"/>
        <br/>
        Password: <input type="password" name="password"/>
        <br/>
        <input type="submit" value="Login"/>
        <br/>
