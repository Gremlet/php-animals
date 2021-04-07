<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$dbname = 'zoo';
$user = 'zooAdmin';
$password = 'zoo';

$dbh = new PDO('mysql:host=localhost;dbname=zoo', $user, $password);

// get an array from categories in order to populate the dropdown
$query_category = "SELECT DISTINCT category FROM animals";

$temp_categories = array();

foreach ($dbh->query($query_category) as $category_result) {
    array_push($temp_categories, $category_result['category']);
}
// get the array from outside the foreach loop
$categories = $temp_categories;
// echo '<pre>';
// print_r($categories);
// echo '</pre>';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <div class="intro">
        <h1>The Zoo</h1>
    </div>
    <div class="form-container">
        <form action="results.php" method="POST" enctype="multipart/form-data" class="form">
            <fieldset>
                <legend>The Zoo</legend>
                <label for="letter">Enter an animal name or part of a name</label>
                <input type="text" id="letter" name="letter" placeholder="E.g. &#8220;älg&#8221; or &#8220;a&#8221;">
                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                <input type="file" name="fileToUpload" id="ftu">
                <label for="category">Choose a type of animal</label>
                <select name="category" id="category">
                    <!--  populated from the database -->
                    <option value="<?php echo $categories[0] ?>"><?php echo $categories[0] ?></option>
                    <option value="<?php echo $categories[1] ?>"><?php echo $categories[1] ?></option>
                    <option value="<?php echo $categories[2] ?>"><?php echo $categories[2] ?></option>
                    <option value="<?php echo $categories[3] ?>"><?php echo $categories[3] ?></option>
                </select>
                <input type="submit" name="submit" value="Submit">
            </fieldset>
        </form>
    </div>
</body>

</html>