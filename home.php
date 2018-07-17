<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/26/16
 * Time: 17:45
 */
include "db_connect.php";

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
    <form method="get" action="org_results.php">
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




</article>



</body>
</html>

