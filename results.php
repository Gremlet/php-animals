<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'zoo';
$user = 'zooAdmin';
$password = 'zoo';

$dbh = new PDO('mysql:host=localhost;dbname=zoo', $user, $password);

if (isset($_POST['submit'])) {

    $query = "SELECT * FROM animals WHERE name LIKE CONCAT('%', :letter, '%') && category = :category ";
    $statement = $dbh->prepare($query, array(PDO::FETCH_ASSOC));

    $statement->execute(array(
        ':letter' => $_POST['letter'],
        ':category' => $_POST['category']
    ));


    $result = $statement->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>

<body>
    <h1>The Zoo</h1>
    <div class="results-table-container">
        <a href="index.php">Go Back</a>
        <?php
        if ($result) {
        ?>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Birthday</th>
                </tr>
            <?php
            foreach ($result as $animals) {
                echo "<tr>";
                echo "<td>" . $animals['id'] . "</td>";
                echo "<td>" . $animals['name'] . "</td>";
                echo "<td>" . $animals['category'] . "</td>";
                echo "<td>" . $animals['birthday'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<p> Sorry, there were no animals in that category with " . "&#8220;" . $_POST['letter'] . "&#8221;
                " . " in the name </p> ";
        }


            ?>


            </table>
            <?php
            if (isset($_POST["submit"])) {
                $uploadDir = "uploads/";
                $uploadPath = $uploadDir . basename($_FILES['fileToUpload']['name']);
                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadPath)) {
                    echo "<p> Filen är uppladdad</p>";
                } else {
                    echo "<p>Något gick fel</p>";
                }

                /*  if (file_exists($uploadPath)) {
                    echo "Sorry, file already exists.";
                  }
                 */
            }
            ?>
    </div>
</body>

</html>