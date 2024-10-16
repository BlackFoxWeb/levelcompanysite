<?php
require './db.php';

session_start();

if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT id, name, phone, email, message, created_at FROM contacts";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Applications</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid black;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    .delete-btn {
      background-color: #ff4c4c;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
    }
    .delete-btn:hover {
      background-color: #ff1a1a;
    }
  </style>
</head>
<body>
<h1>Applications</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Имя</th>
      <th>Телефон</th>
      <th>Email</th>
      <th>Сообщение</th>
      <th>Дата создания</th>
      <th>Удалить</th>
    </tr>
  </thead>
  <tbody id="applicationsList">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["message"] . "</td>";
            echo "<td>" . $row["created_at"] . "</td>";
            echo "<td><form method='POST' action='delete.php'>
                      <input type='hidden' name='id' value='" . $row["id"] . "'>
                      <button type='submit' class='delete-btn'>Удалить</button>
                  </form></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Нет данных</td></tr>";
    }
    $conn->close();
    ?>
  </tbody>
</table>
</body>
</html>