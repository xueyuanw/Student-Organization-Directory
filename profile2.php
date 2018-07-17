<?php

session_start();

require_once "db_connect.php";

$orgID = $_REQUEST["organization_id"];
$sql = "SELECT * FROM student_organizations WHERE organization_id = " . $orgID;
//Generates SQLs for type, function, involvement




$sql_type = "SELECT * FROM types";
$sql_function = "SELECT * FROM function";
$sql_involvement = "SELECT * FROM involvement";


$resultType = mysqli_query($conn, $sql_type);
if(!$resultType){
    exit("SQL Error:" . mysqli_error($conn));

}

$resultFunction = mysqli_query($conn, $sql_function);
if(!$resultFunction){
    exit("SQL Error: " . mysqli_error($conn));

}


$resultInvolvement = mysqli_query($conn, $sql_involvement);
if(!$resultInvolvement){
    exit("SQL Error: " . mysqli_error($conn));
}



$username = $_POST['username'];
$password = $_POST['password'];
// Session Syntax: $_SESSION['var_name']


// Check if user is already logged in.
if ( is_null($_SESSION['logged_in']) ) {
    // User not logged in.

    // Check for empty credentials
    if ( empty($username) || empty($password) ) {
        // Empty credentials.
        include "login.php";
        echo "Please enter username & password.<br>";

        exit();
    }


    $sql = "SELECT * FROM users WHERE username = '". $username. "' AND password = '" . $password. "'";
    $results = mysqli_query($conn, $sql);

    if(mysqli_num_rows($results) > 0){
        // Correct credentials.
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;

    } else {
        // Invalid credentials.
        include "login.php";
        echo "Invalid credentials. <br>";

        exit();
    }

}




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




<body>


<article>



<h1>Dashboard</h1>

Welcome <strong><?php echo  $_SESSION["username"]; ?></strong> !

<br/>

   <form method="get" action="org_results2.php">
        Search for a Student Organization:<br/><br/>
        Organization Name:


        <input type="text" name="organization_name">
        <br/>
        Type:
        <select name="type_id">
            <option value=0 >  All </option>;
            <?php

            while($row = mysqli_fetch_array($resultType)){
                echo "<option value=" . $row["type_id"] . "> " . $row["type"] . "</option>";
            }
            ?>
        </select>
        <br/>
        Function:
        <select name="function_id">
            <option value=0 >  All </option>;
            <?php
            //use while loop to show the genres.
            while($row = mysqli_fetch_array($resultFunction)){
                echo "<option value=" . $row["function_id"] . "> " . $row["function"] . "</option>";
            }
            ?>
        </select>
        <br/>
        Involvement:
        <select name="involvement_id">
            <option value=0 >  All </option>;
            <?php
            //use while loop to show the genres.
            while($row = mysqli_fetch_array($resultInvolvement)){
                echo "<option value=" . $row["involvement_id"] . "> " . $row["involvement"] . "</option>";
            }
            ?>
        </select>
        <br/><br/>



        <input type="submit" >
    </form>

    <div id="dashboardcontent">
        <button>
             <a href="saved.php">Go to My Favourite Organizations</a><br/>
        </button>
    </div>
</article>
