<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO bierenproject_klantinfo (name, email, phone_number) VALUES ('$name', '$email', '$phone_number')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Klant Informatie</h2>
<form method="post" action="klantinfo.php">
  Naam: <input type="text" name="name"><br><br>
  Email: <input type="text" name="email"><br><br>
  Telefoonnummer: <input type="text" name="phone_number"><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
