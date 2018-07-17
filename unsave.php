<?php
session_start();

require_once "db_connect.php";
session_start();




$id=$_GET['organization_id'];
$orgNmae =$_GET['organization_name'];




if(empty($id)){
    exit("Please select a valid name. <a href='home.php'>Go Back</a>");
}
//Test if the user has saved the organization before

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
    <?php




    $sql = "DELETE FROM saved_organizations
            WHERE organization_id=$id";



    $results = mysqli_query($conn, $sql);

    if(!$results){
        exit("SQL Error: " . mysqli_error($conn));
    } else {
        echo $orgNmae." has been removed from your favourites! <br/>";
    }
    ?>

<br/>
    <a href='saved.php'>Back to Saved Lists</a><br/>


</article>


</body>
</html>

