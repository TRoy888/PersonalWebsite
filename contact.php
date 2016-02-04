<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password, 'personalweb', 8889);
if ($conn->connect_errno) {
  $conn->close();
  echo "{messages:'We are currently having a problem with the database. <br>Please send emails to <a href=\'mailto:pakdiyin@usc.edu\'> pakdiyin@usc.edu</a>.<br>Sorry for your inconvenience.', success:false}";
  return;
}

$stmt = $conn->prepare("INSERT INTO messages(name, email, text_message) VALUES (?, ?, ?)");
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
if(empty($name) || empty($email) || empty($message)){
  echo "{messages:'Name, Email, or Messages fields could not be empty.', success:false}";
  $conn->close();
  return;
}
$stmt->bind_param('sss', $name, $email, $message);

$success = $stmt->execute();
if (!$success){
  $conn->close();
  echo "{messages:'There is something wrong with the input. Please verify.', success:false}";
  return;
}
$conn->close();
echo "{messages:'Successful', success:true}";
