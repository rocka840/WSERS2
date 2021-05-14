<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Select, Update, Delete and Insert; 05.05.21</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>

<body>
    <?php
    include_once "dbConnect.php";

    if(isset($_POST["saveCountryId"], $_POST["changeCountryName"])){
        $updateCountrySql = $connection->prepare("Update Countries SET countryName=? where ID_COUNTRY=?");
        $updateCountrySql->bind_param("si", $_POST["changeCountryName"], $_POST["saveCountryId"]);
        $updateCountrySql->execute();
    }

    if (isset($_POST["newCountry"])) {
        $sqlInsert = $connection->prepare("Insert into Countries(countryName) values(?)");
        if (!$sqlInsert)
            die("Error in sql insert statement");
        $sqlInsert->bind_param("s", $_POST["newCountry"]);
        $sqlInsert->execute();
    }

    if (isset($_POST["CountryToDelete"])) {
        $sqlDelete = $connection->prepare("Delete from Countries where ID_COUNTRY = ?");
        if (!$sqlDelete)
            die("Error in sql delete statement");
        $sqlDelete->bind_param("i", $_POST["CountryToDelete"]);
        $sqlDelete->execute();
    }
    if (isset($_POST["CountryToEdit"])) {
        $sqlCountryToEdit = $connection->prepare("Select * from Countries where ID_COUNTRY = ?");
        $sqlCountryToEdit->bind_param("i", $_POST["CountryToEdit"]);
        $sqlCountryToEdit->execute();
        $resultingCountry = $sqlCountryToEdit->get_result();
        $editedCountry = $resultingCountry->fetch_assoc();
    ?>
        <form method="POST">
            <input type="hidden" name="saveCountryId" value="<?= $editedCountry["ID_COUNTRY"] ?>">
            You are editing the country:<input name="changeCountryName" value="<?= $editedCountry["CountryName"] ?>">
            <input type="submit" value="Save changes">
        </form>
    <?php
    } else {
    ?>

        <form method="POST">
            Name of new country to add:<input name="newCountry">
            <input type="submit" value="Add Country">
        </form>

    <?php
    }

    $sqlSelect = $connection->prepare("Select * from Countries");
    if (!$sqlSelect) {
        print "Error in sql";
        exit();
    }

    $sqlSelect->execute();
    $countriesResult = $sqlSelect->get_result();
    while ($currentCountry = $countriesResult->fetch_assoc()) {
    ?>
        <div><?= $currentCountry["CountryName"] ?>
            <form method="POST">
                <input type="hidden" name="CountryToDelete" value="<?= $currentCountry["ID_COUNTRY"] ?>">
                <input type="submit" value="Delete">
            </form>
            <form method="POST">
                <input type="hidden" name="CountryToEdit" value="<?= $currentCountry["ID_COUNTRY"] ?>">
                <input type="submit" value="Edit">
            </form>
        </div>
        <br>

    <?php
    }
    ?>

</body>

</html>