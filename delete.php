<?php
require './db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $sql = "DELETE FROM contacts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Ошибка при удалении записи: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: admin.php");
    exit;
}
?>