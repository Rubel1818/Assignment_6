<?php
// Validate form inputs
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
  die("Please fill out all fields.");
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  die("Invalid email format.");
}

// Save profile picture to server
if (!empty($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
  $filename = uniqid() . '_' . basename($_FILES['profile_picture']['name']);
  $destination = 'uploads/' . $filename;

  if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $destination)) {
    die("Failed to save profile picture.");
  }
} else {
  die("Profile picture is required.");
}

// Save user data to CSV file
$user_data = array($_POST['name'], $_POST['email'], $filename);
$file = fopen('users.csv', 'a');
fputcsv($file, $user_data);
fclose($file);

// Start session and set cookie
session_start();
$_SESSION['name'] = $_POST['name'];
setcookie('name', $_POST['name'], time() + (86400 * 30), '/'); // Cookie expires in 30 days

// Redirect to thank-you page
header('Location: thank-you.html');
exit();
?>
