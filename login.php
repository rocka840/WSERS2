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
if(isset($_POST["Username"],$_POST["Psw"])){
include_once "dbConnect.php";
$sql = $connection->prepare("Select * from ppl where Username=?");
$sql->bind_param("s",$_POST["Username"]);
$sql->execute();
}

?>

<h1>Welcome to this website</h1>
<form method="POST">
    <label for="UserName">Please type your Username</label> <input name="Username">
    <label for="UserName">Password</label> <input name="Psw" type="password">
    <input type="submit" value="login">
</form>

</body>
</html>