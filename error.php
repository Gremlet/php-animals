<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Inline&family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">
    <title>Document</title>
</head>

<body>
    <div class="error">
        <img src="oops.svg" alt="">
        <p>Oops! Looks like you took a wrong turn! <a href="index.php">Click here</a> to go back</p>
    </div>

</body>
<div class="footer">
    <p>SVG emotion by Alina Oleynik from the Noun Project</p>
</div>

</html>