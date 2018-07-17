<?php

$organization_id = $_GET['organization_id'];
if(empty($organization_id)){
    header("Location: home.php");
}

// 1. Establish DB Connection
include "db_connect.php";
// 2. Generate & Submit SQL.



$sql="SELECT * FROM 
student_organizations, function, involvement, types

WHERE student_organizations.type_id=types.type_id
AND student_organizations.function_id=function.function_id
AND student_organizations.involvement_id=involvement.involvement_id
AND organization_id = $organization_id
 ";

$results = mysqli_query($conn, $sql);
if(!$results){
    exit("SQL Error:" . mysqli_error($conn));

}

// 3. Display data.

$row = mysqli_fetch_array($results);


?>


<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Show Studnet Organizations Search Result</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">


    <!-- Latest compiled and minified JavaScript -->
    <script src="http://code.jquery.com/jquery-1.12.3.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
        $(function(){

            $('.save').on('click',function(){
                $('#LoginRequestdetail').fadeIn(800);
            });
            $('#cancel').on('click',function(){
                $('#LoginRequestdetail').fadeOut(500);
            });

        });






    </script>


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
<br/>
<br/>
<br/>


    <div id="LoginRequestdetail">
        Please <a href='login.php'>Log in </a>first to save your interested organizations! <br/>

        <a href='#' id="cancel">Cancel</a>

    </div>

    <div style="width: 700px; margin: auto; height: 500px;">

        <h2><?php echo $row['organization_name']; ?></h2><br/>
        <strong>Type:  </strong><?php echo $row['type']; ?><br/>
        <strong>Function:  </strong><?php echo $row['function']; ?><br/>
        <strong>Involvement:  </strong><?php echo $row['involvement']; ?><br/>
        <strong>Email:  </strong>
        <a href="mailto:<?php echo $row['email']; ?>"><?php echo $row['email']; ?></a><br/>
        <strong>Details:</strong><br/>
        <?php echo $row['details']; ?><br/>
        <strong>Link:</strong><br/>
        <a href="<?php echo $row['organization_link']; ?>"><?php echo $row['organization_link']; ?></a>
        <br/><br/>
        <strong>Save to My Favourites:</strong><br/>

        <a href='#'class='save'>[Save]</a><br/>

    </div>

<br/>
<br/>

<br/>

<br/>




</body>
</html>

