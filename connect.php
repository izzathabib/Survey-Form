<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit']) {
 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bootcampsurvey";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
    echo "Connected successfully";
  }
  //Assign variable to the submitted input
  $name = $_POST["name"];
  $email = $_POST["email"];
  $age = $_POST["age"];
  $role = $_POST["role"];
  $feature = $_POST["feature"];
  $recommend = $_POST["recommend"];
  $improve = implode(",", $_POST["checkboxes"]);//Implode used to store multiple value of checkboxes
  $comment = $_POST["comments"];
  
  //Insert data to MySQL
  $sql = "INSERT INTO person(NAME, EMAIL, AGE, ROLE, FEATURE, RECOMMEND, IMPROVE, COMMENT) 
  VALUES ('$name', '$email', '$age', '$role', '$feature', '$recommend', '$improve', '$comment')";
  // Check if data inserted successfully
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  
}
?>
