<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Survey Form</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1 id="title">BootCamp Survey Form</h1>
  <p id="description">Thank you for taking the time to help us improve the platform</p>

  <form id="survey-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <fieldset class="form-group">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" pattern="[a-Aa-A]" required>
    </fieldset>
    <fieldset class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
    </fieldset>
    <fieldset class="form-group">
      <label id="age">Age</label>
      <input type="number" id="age" name="age" min="1" max="100" placeholder="Age">
    </fieldset>
    <!--No 12-->
    <fieldset class="form-group">
      <label for="role">Which option best describes your current role?</label>
      <select id="role" name="role">
        <option value="Select current role">Select current role</option>
        <option value="Full time job">Full time job</option>
        <option value="Full time learner">Full time learner</option>
        <option value="Prefer not to say">Prefer not to say</option>
        <option value="Other">Other</option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label for="feature">What is your favorite feature of BootCamp?</label>
      <select id="feature" name="feature">
        <option value="Select an option">Select an option</option>
        <option value="Challenges">Challenges</option>
        <option value="Projects">Projects</option>
        <option value="Community">Community</option>
        <option value="Open Source">Open Source</option>
      </select>
    </fieldset>
    <fieldset class="form-group">
      <label for="recommend">Would you recommend BootCamp to a friend?</label>
      <label for="definitely"><input type="radio" name="recommend" value="Definitely" class="inline" id="definitely">Definitely</label>
      <label for="maybe"><input type="radio" name="recommend" value="Maybe" class="inline" id="maybe">Maybe</label>
      <label for="not-Sure"><input type="radio" name="recommend" value="Not sure" class="inline" id="not-Sure">Not sure</label>
      <label for="nope"><input type="radio" name="recommend" value="Nope" class="inline" id="nope">Nope</label>
    </fieldset>
    <fieldset class="form-group">
      <label for="checkboxes">What would you like to see improved? (Check all that apply)</label>
      <label for="checkbox1"><input type="checkbox" id="checkbox1" name="checkboxes[]" value="Front-end project" class="inline"> Front-end project</label>
      <label for="checkbox2"><input type="checkbox" id="checkbox2" name="checkboxes[]" value="Back-end project" class="inline"> Back-end project</label>
      <label for="checkbox3"><input type="checkbox" id="checkbox3" name="checkboxes[]" value="Data visualization" class="inline"> Data visualization</label>
      <label for="checkbox4"><input type="checkbox" id="checkbox4" name="checkboxes[]" value="Challenges" class="inline"> Challenges</label>
      <label for="checkbox5"><input type="checkbox" id="checkbox5" name="checkboxes[]" value="Open source community" class="inline"> Open source community</label>
      <label for="checkbox6"><input type="checkbox" id="checkbox6" name="checkboxes[]" value="Gitter help rooms" class="inline"> Gitter help rooms</label>
      <label for="checkbox7"><input type="checkbox" id="checkbox7" name="checkboxes[]" value="Videos" class="inline"> Videos</label>
      <label for="checkbox8"><input type="checkbox" id="checkbox8" name="checkboxes[]" value="City meetups" class="inline"> City meetups</label>
      <label for="checkbox9"><input type="checkbox" id="checkbox9" name="checkboxes[]" value="Wiki" class="inline"> Wiki</label>
      <label for="checkbox10"><input type="checkbox" id="checkbox10" name="checkboxes[]" value="Forum" class="inline"> Forum</label>
      <label for="checkbox11"><input type="checkbox" id="checkbox11" name="checkboxes[]" value="Additional courses" class="inline"> Additional courses</label>
    </fieldset>
    <fieldset class="form-group">
      <label for="textarea">Any comments or suggestions?</label>
      <textarea id="textarea" name="comments" rows="3" cols="30" placeholder="Type your comment here..."></textarea>
    </fieldset>
    <button type="submit" id="submit-button" name="submit" value="submit">Submit</button>
  </form>

  <!-- Connect & store to database -->
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit']) {
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bootcampsurvey";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Funtion to sanitize data
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    /* Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    } else {
      echo "Connected successfully";
    }*/

    //Assign variable to the submitted input
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $age = test_input($_POST["age"]);
    $role = $_POST["role"];
    $feature = $_POST["feature"];
    $recommend = $_POST["recommend"];
    $improve = implode(",", $_POST["checkboxes"]);//Implode used to store multiple value of checkboxes
    $comment = test_input($_POST["comments"]);
    
    //Insert data to MySQL
    $sql = "INSERT INTO person(NAME, EMAIL, AGE, ROLE, FEATURE, RECOMMEND, IMPROVE, COMMENT) 
    VALUES ('$name', '$email', '$age', '$role', '$feature', '$recommend', '$improve', '$comment')";
    // Check if data inserted successfully
    if (mysqli_query($conn, $sql)) {
      echo "<script>";
      echo "alert('Your form has been submitted successfully!');";
      echo "</script>";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
  }
?>


</body>
</html>
