<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "lab";
  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $method = $_GET['method'];
  $user_id = $_GET['user_id'];
  $director_id = $_GET['director_id'];

  if ($method == "Like") {
    mysqli_query($conn,"INSERT INTO favs (user_id, director_id) VALUES ('$user_id', '$director_id')");
  }
  else {
    mysqli_query($conn,"DELETE FROM favs WHERE user_id = '$user_id' AND director_id = '$director_id'");
  }
?>
