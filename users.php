<?php
// Read user data from CSV file
$users = array();
if (($handle = fopen("users.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $users[] = $data;
  }
  fclose($handle);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Users</title>
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      padding: 5px;
    }
  </style>
</head>
<body>
  <h1>Users</h1>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
      <th>Profile Picture</th>
    </tr>
    <?php foreach ($users as $user): ?>
      <tr>
        <td><?= $user[0] ?></td>
        <td><?= $user[1] ?></td>
        <td><img src="uploads/<?= $user[2] ?>" width="50"></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
