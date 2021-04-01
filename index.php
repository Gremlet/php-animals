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

    // testing that query works. Will do actual rendering later
    foreach ($result as $animals) {
        echo $animals['name'] . "<br/>";
    }
}
// get an array from categories in order to populate the dropdown
$query_category = "SELECT DISTINCT category FROM animals";

$temp_categories = array();

foreach ($dbh->query($query_category) as $category_result) {
    array_push($temp_categories, $category_result['category']);
}
// get the array from outside the foreach loop
$categories = $temp_categories;
echo '<pre>';
print_r($categories);
echo '</pre>';


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
            <!--  populated from the database -->
            <option value="<?php echo $categories[0] ?>"><?php echo $categories[0] ?></option>
            <option value="<?php echo $categories[1] ?>"><?php echo $categories[1] ?></option>
            <option value="<?php echo $categories[2] ?>"><?php echo $categories[2] ?></option>
            <option value="<?php echo $categories[3] ?>"><?php echo $categories[3] ?></option>
        </select>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>

</html>