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
    include_once("dbConnect.php");
    /*
if (
    isset($_POST["FName"])&&
    isset($_POST["LName"])&&
) this is a longer way to do it*/

    if (
        isset(
            $_POST["FirstName"],
            $_POST["LastName"],
            $_POST["Age"],
            $_POST["UserName"],
            $_POST["Psw"],
            $_POST["Psw2"],
            $_POST["Country"]
        )
    ) {
        print "We are trying to sign you up!";
        if ($_POST["Psw"] == $_POST["Psw2"]) {
            //we are ok -we will start instert this into db

            $sql = $connection->prepare("INSERT INTO PPL(FirstName, LastName, Age, UserName, Psw, ID_COUNTRY) VALUES(?,?,?,?,?,?)");

            if (!$sql) {
                print "Error in your sql";
            }

            $hashedPassword = password_hash($_POST["Psw"], PASSWORD_BCRYPT);

            $sql->bind_param(
                "ssissi",
                $_POST["FirstName"],
                $_POST["LastName"],
                $_POST["Age"],
                $_POST["UserName"],
                $hashedPassword,
                $_POST["Country"]
            );

            $resultOfExecute = $sql->execute();
            if ($resultOfExecute) {
                print "We are done. Please check the database...";
            } else {
                print 'Problem running execute.';
            }
        } else {
            print "Passwords not matching.";
        }
    }
    ?>


    <h1>Welcome to our page. You will signup here</h1>
    <div class="container">
        <form class="myRegistration" method="POST"><BR>
            <label for="FirstName">First Name</label> <input name="FirstName"><BR>
            <label for="LastName">Last Name</label> <input name="LastName"><BR>
            <label for="Age">Age</label> <input name="Age"><BR>
            <label for="UserName">Username</label> <input name="UserName"><BR>
            <label for="Psw">Password</label> <input name="Psw" type="password"><BR>
            <label for="Psw2">Re-type Password</label> <input name="Psw2" type="password"><BR>

            <label for="Country">Choose your country:</label>
            <select name="Country">

                <?php
                $sqlSelect = $connection->prepare("SELECT * from Countries");
                $selectionWentOK = $sqlSelect->execute();

                if ($selectionWentOK) {

                    $result = $sqlSelect->get_result();
                    while ($row = $result->fetch_assoc()) {
                ?>
                        <option value="<?= $row["ID_COUNTRY"] ?>"><?= $row["CountryName"] ?></option>
                <?php
                    }
                } else {
                    print "Something went wrong when selecting data";
                }
                ?>

            </select>

            <input type="submit" name="submit">
        </form>

                <p><a href="login.php">Click here to go to Login Page!</p>

</body>

</html>