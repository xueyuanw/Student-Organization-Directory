<?php
//1. connect to database;
include "db_connect.php";
$orgID = $_REQUEST["organization_id"];
$sql = "SELECT * FROM student_organizations WHERE organization_id = " . $orgID;
//Generates SQLs for type, function, involvement


$results_per_page = 5;
$current_page = $_GET['page'];
$first_page = 1;

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



//save $Requests to variables.
$name = $_REQUEST["organization_name"];
$typeId = $_REQUEST["type_id"];
$functionId = $_REQUEST["function_id"];
$involvementId = $_REQUEST["involvement_id"];
$linkId = $_REQUEST["organization_link"];
$emailId = $_REQUEST["email"];
$details = $_REQUEST["details"];


$sql="SELECT * FROM 
student_organizations, function, involvement, types

WHERE student_organizations.type_id=types.type_id
AND student_organizations.function_id=function.function_id
AND student_organizations.involvement_id=involvement.involvement_id
 ";


if(!empty($_REQUEST["type_id"])){
    $sql = $sql. " AND student_organizations.type_id= $typeId";
}

if(!empty($_REQUEST["function_id"])) {
    $sql = $sql . " AND student_organizations.function_id=$functionId";
}


if (!empty($_REQUEST["organization_name"])) {
    $sql = $sql . " AND organization_name LIKE '%" . $name . "%'";
}

if(!empty($_REQUEST["involvement_id"])) {
    $sql = $sql . " AND student_organizations.involvement_id=$involvementId";
}


$results = mysqli_query($conn, $sql);


if(empty($results)){
    exit("SQLError" . mysqli_error($conn));


}



$total_results = mysqli_num_rows($results);
$last_page = ceil($total_results/$results_per_page);

if(empty($current_page)) {
    $current_page = $first_page;
} elseif ($current_page < $first_page) {
    $current_page = $first_page;
} elseif ($current_page > $last_page) {
    $current_page = $last_page;
}


$start_index = ($current_page-1) * $results_per_page;

$sql = $sql . " LIMIT $start_index, $results_per_page";


$results = mysqli_query($conn, $sql);

if (!$results) {
    exit("SQL Error: " . mysqli_error($conn));


}

// 3. Display results

//echo "Your query returned " . mysqli_num_rows($results) . " results.<br><br>";



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
                $('#LoginRequest').fadeIn(800);
            });
            $('#cancel').on('click',function(){
                $('#LoginRequest').fadeOut(500);
            });

        });






    </script>
    <style>
        th{
            border-left:2px solid black;
            border-top:2px solid black;
            border-bottom:2px solid  black;
            border-right:2px solid black;
            text-align: center;
        }
        td{
            text-align: center;
            padding:2px;
            border:1px solid black;

        }


    </style>
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



    <div id="LoginRequest">
        Please <a href='login.php'>Log in </a>first to save your interested organizations! <br/>

        <a href='#' id="cancel">Cancel</a>

    </div>

    <div id="search">

        <form method="get" action="org_results.php">
            Search :<br/><br/>
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
            <input type="submit"><br/>
            <?php

            echo "Your search has ". $total_results . " student organizations. <br /><br/>";


            ?>
        </form>

    <br style="clear:both">
    </div>

    <content>
    <table>
        <tr>

            <th>Organization Name</th>

            <th>Type</th>
            <th>Function</th>
            <th>Involvement</th>
            <th>Email</th>

            <th>Save</th>
            <th>Details</th>




        </tr>

        <?php
        echo "Showing $results_per_page of $total_results results.";
        //Output all the result in a line. Build a link to detail page using id. @TODO
        while($currentrow = mysqli_fetch_array($results)){
            echo"<tr>";


            echo"<td class='organization_name'>". $currentrow['organization_name']."</td>";


            echo"<td class='type'>". $currentrow['type']."</td>";
            echo"<td class='function'>". $currentrow['function']."</td>";
            echo"<td class='involvement'>". $currentrow['involvement']."</td>";
            echo"<td class='email'>". $currentrow['email']."</td>";
            /*echo"<td class='organization_link'>". "<a href='".$currentrow['organization_link'].
                    "'target='new' >".$currentrow['organization_link']."</a></td>";*/

            echo "<td class='save'><a href='# '>
            SAVE
            </a></td>";

            echo "<td><a href='details.php?organization_id=" . $currentrow['organization_id'] . "'>Details</a></td>";

            echo"</tr>";
        }
        ?>

    </table>


        <br>



        <div>
            <a href="org_results.php?organization_name=<?php echo $name; ?>&type_id=<?php echo $typeId; ?>&function_id=<?php echo $functionId; ?>&involvement_id=<?php echo $involvementId; ?>&email=<?php echo $emailId; ?>&page=<?php echo ($first_page); ?>">
                [<< First]
            </a>
            <a href="org_results.php?organization_name=<?php echo $name; ?>&type_id=<?php echo $typeId; ?>&function_id=<?php echo $functionId; ?>&involvement_id=<?php echo $involvementId; ?>&email=<?php echo $emailId; ?>&page=<?php echo ($current_page-1); ?>">
                [< Previous]
            </a>

            <?php echo "$current_page of $last_page"; ?>

            <a href="org_results.php?organization_name=<?php echo $name; ?>&type_id=<?php echo $typeId; ?>&function_id=<?php echo $functionId; ?>&involvement_id=<?php echo $involvementId; ?>&email=<?php echo $emailId; ?>&page=<?php echo ($current_page+1); ?>">
                [Next >]
            </a>
            <a href="org_results.php?organization_name=<?php echo $name; ?>&type_id=<?php echo $typeId; ?>&function_id=<?php echo $functionId; ?>&involvement_id=<?php echo $involvementId; ?>&email=<?php echo $emailId; ?>&page=<?php echo $last_page; ?>">
                [Last >>]
            </a>
        </div>

        <div style="margin-bottom:200px;"></div>
    </content>
</body>
</html>