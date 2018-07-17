<?php

// 1. Connect to DB.
require_once "db_connect.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);



?>
<html>
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
<form method="post" action="signup.php">
    <?php

    if ( !empty($username) && !empty($email) && !empty($password) ) {



        $sql = "INSERT INTO users (username, email, password)
    VALUES ('$username', '$email', '$password')";

        $results = mysqli_query($conn, $sql);
        if(!$results){
            exit("INSERT SQL Error: " . mysqli_error($conn));
        }

        $subject = "Registration was successful.";

        $msg = "<h1>Hello:</h1>";
        $msg = $msg . "<strong>$username</strong> was successfully registered.";

        $header = "From: registration@usc.edu";
        $header = $header . "\r\n";
        $header = $header . "Content-type: text/html";

        if (mail($email, $subject, $msg, $header) ){
            echo "Confirmation email sent. <br>";
        } else {
            echo "Email server error.<br>";
        }

        exit("Your account <strong> $username</strong> was successfully created. <a href='profile2.php'>
            <br/>Go to Dashboard.</a>");

    } else {
        echo "Please fill out all the fields.<br><br/>";
    }

    ?>

    Username: <input type="text" name="username"/>
    <br/>
    Email: <input type="email" name="email"/>
    <br/>
    Password: <input type="password" name="password"/>
    <br/>
    <input type="submit" value="Sign Up"/>
    <br/>

