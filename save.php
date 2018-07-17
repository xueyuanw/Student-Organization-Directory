<?php
session_start();
require_once "db_connect.php";


    unset($_SESSION["loggedin"]);




    $name = $_GET["organization_name"];

    $id=$_GET['organization_id'];

    $typeId = $_REQUEST["type_id"];
    $functionId = $_REQUEST["function_id"];
    $involvementId = $_REQUEST["involvement_id"];

    $emailId = $_REQUEST["email"];


    if(empty($name)){
        exit("Please enter a valid name. <a href='home.php'>Go Back</a>");
    }
    //Test if the user has saved the organization before

    $sql_TEST = "SELECT * FROM saved_organizations 
                  WHERE organization_id =".$id." AND username='".$_SESSION['username']."'";


?>


<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="main.css">

</head>
<body>
<nav>

    <div id="nav-wrapper">
        <a id="usc-logo" href="http://usc.edu" target="new">University of Southern California </a>

        <div id="home">
            <a href="profile2.php">
                <?php echo $_SESSION['username']?> Dashboard
            </a>
        </div>
        <div id="home2">
            <a href="saved.php">
                Favourites
            </a>
        </div>
        <div id="login">
            <a href="logout.php">Log Out</a>
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
    <?php

    $testResults= mysqli_query($conn, $sql_TEST);


    if(mysqli_num_rows($testResults)==0) {

        $sql = "INSERT INTO saved_organizations (saved_organization_name, organization_id, username,type_id, function_id,involvement_id,email)
            VALUES ('$name', $id,'".$_SESSION['username']."',$typeId,$functionId,$involvementId,'$emailId')";
        $results = mysqli_query($conn, $sql);


        if (!$results) {
            exit("SQL Error: " . mysqli_error($conn));

        } else {
            echo "'$name' is succesfully saved to <strong>".$_SESSION["username"]." </strong> favourites.";
            
            
            


        }
    }
    else{
        echo "You have already saved the organization!<br/>";

    }

    ?>
    <br/>
        <a href='org_results2.php'>Back to Search</a><br/>


    </article>


    </body>
    </html>

