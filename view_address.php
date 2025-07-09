<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "code_camp_bd_fos";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$address = "";
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // SQL query to fetch address based on ID
    $sql = "SELECT address FROM dona_tion WHERE id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $address = $row["address"];
    } else {
        $address = "Address not found.";
    }
} else {
    $address = "No ID provided.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f3f4f6;
            display
