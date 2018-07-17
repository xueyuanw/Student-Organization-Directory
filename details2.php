<?php
session_start();
require_once "db_connect.php";


$organization_id = $_GET['organization_id'];
if(empty($organization_id)){
    header("Location: org_results2.php");
}



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

$sql_TEST = "SELECT * FROM saved_organizations 
                  WHERE organization_id =".$organization_id." AND username='".$_SESSION["username"]."'";


$testResults= mysqli_query($conn, $sql_TEST);

if(mysqli_num_rows($testResults)==0){

    $Save ="<a href='save.php?organization_id=". $row['organization_id']."&organization_name=".$row['organization_name']."&type_id=" . $row['type_id'] .
        "&function_id=" . $row['function_id'] .
        "&involvement_id=" . $row['involvement_id'] .
        "&email=" . $row['email'] ."'>[Save]</a>";


}
else{
    $Save ="<a href='unsave.php?organization_id=". $row['organization_id']."&organization_name=".$row['organization_name']."'>[UnSave]</a>";
    $saved="[Saved]";
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
        <?php echo $_SESSION["username"];?>'s Favourite USC Organizations
    </div>
</header>

<br/>
<br/>
<br/>


<div style="width: 700px; margin: auto; height: 500px;">

    <h2><?php echo $row['organization_name']."<br/>".$saved; ?></h2><br/>


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


   <?php echo $Save?>

</div>

<br/>
<br/>

<br/>

<br/>




</body>
</html>

