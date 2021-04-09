<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$con=mysqli_connect("localhost","mohammadali","","form") or die(mysqli_error());

if((isset($_POST['submit']))){
$id = $con->real_escape_string($_POST['ID']);
$firstname = $con->real_escape_string($_POST['FirstName']);
$lastname = $con->real_escape_string($_POST['LastName']);
$username = $con->real_escape_string($_POST['UserName']);
$email = $con->real_escape_string($_POST['Email']);
$city = $con->real_escape_string($_POST['City']);


$sql="INSERT INTO contacts (ID,FirstName, LastName, UserName, Email, City) VALUES ('".$id."','".$firstname."','".$lastname."', '".$username."', '".$email."', '".$city."')";
  //Execute the query and returning a message



if(!$result = $con->query($sql))
    {
    die('Error occured [' . $con->error . ']');
    }
    else
       echo '<h2 class="message">Thank you for filling out your information!</h2>';
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="style.css" />

</head>

<body ">
  <div class="container">
    <h2 class="h2">Signup Form</h2>
    <form class="row g-3" action="signup.php" method="POST">
      <div class="col-md-4">
        <label for="validationServer01" class="form-label">First name</label>
        <input type="text" class="form-control" id="FirstName" name="FirstName" required />
      </div>
      <div class="col-md-4">
        <label for="validationServer02" class="form-label">Last name</label>
        <input type="text" class="form-control" id="LastName" name="LastName" required />
      </div>
      <div class="col-md-4">
        <label for="validationServerUsername" class="form-label">Username</label>
        <div class="input-group has-validation">
          <input type="text" class="form-control" id="UserName" name="UserName"
            aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required />
        </div>

      </div>
      <div class="class=" col-md-6"">
        <label for="validationCustomEmail" class="form-label">Email</label>
        <input type="text" class="form-control" id="Email" name="Email" aria-describedby="validationServer03Feedback"
          required />
      </div>
      <div class="col-md-6">
        <label for="validationServer03" class="form-label">City</label>
        <input type="text" class="form-control" id="City" name="City" aria-describedby="validationServer03Feedback"
          required />
      </div>
      <div class="col-md-4">
        <label for="validationServer01" class="form-label">ID</label>
        <input type="Number" class="form-control" id="ID" name="ID" required />
      </div>

      <div class="col-12">
        <div class="form-check">
          <input class="form-check-input is-invalid" type="checkbox" value="" id="invalidCheck3"
            aria-describedby="invalidCheck3Feedback" required />
          <label class="form-check-label" for="invalidCheck3">
            Agree to terms and conditions
          </label>
          <div id="invalidCheck3Feedback" class="invalid-feedback">
            You must agree before submitting.
          </div>
        </div>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit" name="submit">
          Submit form
        </button>
      </div>
    </form>
  </div>

  <main>
    <div class="result">

    <?php 
    try{
      $pdo = new PDO("mysql:host=localhost;dbname=form", "mohammadali", "");
      // Set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e){
      die("ERROR: Could not connect. " . $e->getMessage());
  }
    try{
      $sql = "SELECT * FROM contacts";   
      $result = $pdo->query($sql);
      if($result->rowCount() > 0){
          echo '<table class="table">';
              echo '<thead class="thead-dark">';
              echo "<tr>";
                  echo '<th scope="col">ID</th>';
                  echo '<th scope="col">FirstName</th>';
                  echo '<th scope="col">LastName</th>';
                  echo '<th scope="col">UserName</th>';
                  echo '<th scope="col">Email</th>';
                  echo '<th scope="col">City</th>';
                  echo '<th scope="col">Delete</th>';


  
              echo "</tr>";
              echo '</thead>';
          while($row = $result->fetch()){
              echo '<tbody>';
              echo "<tr>";
                  echo "<td>" . $row['ID'] . "</td>";
                  echo "<td>" . $row['FirstName'] . "</td>";
                  echo "<td>" . $row['LastName'] . "</td>";
                  echo "<td>" . $row['UserName'] . "</td>";
                  echo "<td>" . $row['Email'] . "</td>";
                  echo '<td>' . $row['City'] .' </td>';
                  echo '<td><i class="bi bi-trash"></i></td>';

              echo "</tr>";
              echo '</tbody>';
          }
          echo '</table>';
          // Free result set
          unset($result);
      } else{
          echo "No records matching your query were found.";
      }
  } catch(PDOException $e){
      die("ERROR: Could not able to execute $sql. " . $e->getMessage());
  }
    ?>
    </div>

  </main>
</body>
<style>

*{
    margin: 0;
    padding: 0;
}
body{
    background:linear-gradient(to right top,#65dfc9,#6cdbeb);  


}
main{
    display: flex;
    align-items: center;
    justify-content: center;

}
.container{
    width: 500px;
    height: 500px;
    background:linear-gradient(to right bottom, rgb(255, 255, 255,0.7),rgba(255, 255, 255, 0.3));  
    margin-top: 50px;
    border-radius: 2em;

}
.result{
    background: white;
    margin-top: 20px;
    min-height: 200px;
    width: 800px;
    background:linear-gradient(to right bottom, rgb(255, 255, 255,0.7),rgba(255, 255, 255, 0.3));  
    border-radius: 1rem;
}
 .h2{
    text-align: center;
    padding-top: 10px;
    padding-bottom: 10px;
    font-family: sans-serif;
}
.message{
    text-align: center;
    margin-top: 20px;
}
</style>
</html>