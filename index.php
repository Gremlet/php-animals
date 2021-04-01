<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {

    $host = 'localhost';
    $dbname = 'zoo';
    $user = 'zooAdmin';
    $password = 'zoo';

    $dbh = new PDO('mysql:host=localhost;dbname=zoo', $user, $password);

    $query = "SELECT * FROM animals WHERE name LIKE CONCAT('%', :letter, '%') && category = :category ";
    $statement = $dbh->prepare($query, array(PDO::FETCH_ASSOC));

    $statement->execute(array(
        ':letter' => $_POST['letter'],
        ':category' => $_POST['category']
    ));


    $result = $statement->fetchAll();


    foreach ($result as $animals) {
        echo $animals['name'] . "<br/>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="POST">
        <label for="letter">Enter a letter</label>
        <input type="text" id="letter" name="letter">
        <label for="category">Choose a type of animal</label>
        <select name="category" id="category">
            <option value="Däggdjur">Däggdjur</option>
            <option value="Fisk">Fisk</option>
            <option value="Fågel">Fågel</option>
            <option value="Insekt">Insekt</option>
        </select>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>