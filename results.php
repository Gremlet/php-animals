<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require("config.php");

if (!isset($_POST['submit'])) {
    header('location: error.php');
}

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
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    <title>Results</title>
</head>

<body>
    <h1>The Zoo</h1>
    <p class="show-text">
        <?php
        if (isset($_POST["submit"])) {
            $uploadDir = "uploads/";
            $name = $_FILES['fileToUpload']['name'];
            $uploadPath = $uploadDir . basename($name);
            $temp = $_FILES['fileToUpload']['tmp_name'];
            $fileName = pathinfo($name, PATHINFO_FILENAME);
            $extension = pathinfo($name, PATHINFO_EXTENSION);
            $counter = 1;

            if (file_exists($uploadDir . $fileName . '.' . $extension)) {
                $name = $fileName . '-' . $counter . '.' . $extension;
                $uploadPath = $uploadDir . basename($name);
                $counter++;
            }

            if (move_uploaded_file($temp, $uploadPath)) {
                echo "File " . $name . " is uploaded!";
            } else {
                echo "There was an error uploading the file, please try again!";
            }
        }
        ?></p>
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

    </div>
    <div class="image-container">
        <?php

        if (isset($_FILES['file'])) {

            $file_name = $_FILES['file']['name'];
            $file_size = $_FILES['file']['size'];
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_type = $_FILES['file']['type'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);;

            $uploadDir = "uploads/";
            $uploadPath = $uploadDir . basename($file_name);

            $extensions = array("jpeg", "jpg", "png");


            if (in_array($file_ext, $extensions) === true && $file_size < 3000000) {
                move_uploaded_file($file_tmp, $uploadPath);

                echo "Successfully uploaded " . $file_name . " !";
        ?>

                <h1>Your image</h1>

                <img src="uploads/<?php echo $file_name ?>" alt="">


        <?php
            } else {
                echo "No file uploaded. Make sure to only upload jpeg or png files.";
            }
        }

        ?>


    </div>

</body>

</html>