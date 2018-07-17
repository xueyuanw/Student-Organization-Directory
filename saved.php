<?php
//1. connect to database;
session_start();
require_once "db_connect.php";

//save $Requests to variables.


if ( is_null($_SESSION['logged_in']) ) {
// User not logged in.

// Check for empty credentials

}

$sql = "SELECT organization_name, student_organizations.details, student_organizations.organization_id,
		types.type,function.function, involvement.involvement,student_organizations.email,username
          FROM saved_organizations
            INNER JOIN student_organizations
            ON (saved_organizations.organization_id=student_organizations.organization_id)
			INNER JOIN types
			ON (saved_organizations.type_id=types.type_id)
			INNER JOIN function
			ON (saved_organizations.function_id=function.function_id)
			INNER JOIN involvement
			ON (saved_organizations.involvement_id=involvement.involvement_id)
            AND username = '".$_SESSION['username']."'					";



//run SQL & check for result

$results = mysqli_query($conn, $sql);
if(!$results){
    exit("SQL Error: " . mysqli_error($conn));
}



?>


<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Show Studnet Organizations Search Result</title>

    <link rel="stylesheet" href="main.css">

    <style>
        th{
            border-left:2px solid black;
            border-top:2px solid black;
            border-bottom:2px solid  black;
            border-right:2px solid black;
        }
        td{
            text-align: center;
            padding:2px;
            border-bottom:1px solid black;
            border-right:1px solid darkred;
        }


    </style>
</head>
<body>
<nav>


    <div id="nav-wrapper">
        <a id="usc-logo" href="http://usc.edu" target="new">University of Southern California </a>

        <div id="home">
            <a href="profile2.php?username=<?php echo $_SESSION["username"]?>">
                <?php echo $_SESSION["username"]?> Dashboard
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
       <?php echo $_SESSION["username"];?>'s Favourite USC Organizations
    </div>
</header>


<content>

    <?php

    echo "You saved ". mysqli_num_rows($results) . " student organizations. <br /><br/>";
    ?>

    <table>
    <tr>
        <th>ID</th>
        <th>Organization Name</th>

        <th>Type</th>
        <th>Function</th>
        <th>Involvement</th>
        <th>Email</th>
        <th>Saved</th>
        <th>Details</th>




    </tr>

    <?php

    //Output all the result in a line. Build a link to detail page using id. @TODO
    while($currentrow = mysqli_fetch_array($results)){
        echo"<tr>";
        echo"<td class='id'>". $currentrow['organization_id']."</td>";

        echo"<td class='organization_name'>". $currentrow['organization_name']."</td>";


        echo"<td class='type'>". $currentrow['type']."</td>";
        echo"<td class='function'>". $currentrow['function']."</td>";
        echo"<td class='involvement'>". $currentrow['involvement']."</td>";
        echo"<td class='email'>". $currentrow['email']."</td>";


        echo "<td><a href='unsave.php?organization_id=" . $currentrow['organization_id'] . "&organization_name=" . $currentrow['organization_name'] .
            "&username=" . $currentrow['username']. "'>UNSAVE</a></td>";
        echo "<td><a href='details2.php?organization_id=" . $currentrow['organization_id'] . "'>Details</a></td>";

        echo"</tr>";
    }
    ?>

</table>
</content>
</body>
</html>