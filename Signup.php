<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>

<?php
/*
if (
    isset($_POST["FName"])&&
    isset($_POST["LName"])&&
) this is a longer way to do it*/

if (
    isset($_POST["FName"],
    $_POST["LName"],
    $_POST["Age"],
    $_POST["UserName"],
    $_POST["Pswrd"],
    $_POST["RePswrd"])
    ) {
        print "We are signed up!";
        if($_POST["Pswrd"]==$_POST["RePswrd"])
        {
            //we are ok -we will start instert this into db
            include_once("dbConnect.php");
            $sql = $connection->prepare("INSERT INTO PPL(FirstName, LastName, Age, Username, Pswrd) VALUES(?,?,?,?,?)");

            if(!$sql){
                print "Error in your sql";
            }

            $sql -> bind_param("ssiss", $_POST["FirstName"],
                                        $_Post["LastName"],
                                        $_POST["Age"],
                                        $_POST["Username"],
                                        $_POST["Pswrd"]
                                                        );

     $sql->execute(); //run this
        } 
        else {
            //NOT OK
            print "The two passwords DONT match, please try again";
        }

    }
?>


<h1>Welcome to our page. You will signup here</h1>
<div class="container">
<form class="myRegistration" method="POST"><BR>
    <label for="FName">First Name</label> <input name="FName"><BR>
    <label for="LName">Last Name</label> <input name="LName"><BR>
    <label for="Age">Age</label> <input name="Age"><BR>
    <label for="UserName">Username</label> <input name="UserName"><BR>
    <label for="Pswrd">Password</label> <input name="Pswrd" type="password"><BR>
    <label for="RePswrd">Re-type Password</label> <input name="RePswrd" type="password"><BR>
    <input type="submit" name="submit">
</form>
</body>
</html>